<?php

namespace App\Infrastructure\Service\AccessToken;

use App\Domain\Entity\UserEntity\User;
use App\Domain\Repository\AccessToken\AccessTokenRepositoryInterface;
use App\Domain\Service\AccessToken\AccessTokenServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class AccessTokenService implements AccessTokenServiceInterface
{
    public function __construct(
        private AccessTokenRepositoryInterface $accessTokenRepository,
        private EntityManagerInterface         $entityManager,
        private Security                       $security,
    )
    { }

    public function generateToken(User $user): string
    {
        try {
            $this->entityManager->beginTransaction();

            if ($this->hasTokenForUse($user)) {
                return  $this->findTokenByUser($user);
            }

            $tokenMounted = hash('sha512', random_bytes(32));

            $this->accessTokenRepository->createTokenForUser($user, $tokenMounted);

            $this->entityManager->commit();

            return $tokenMounted;
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw new \Exception($e->getMessage());
        }
    }

    public function findTokenByUser(User $user): ?string
    {
        $tokens = $this->accessTokenRepository->findTokenByUser($user);

        return $this->getTokenActive($tokens);
    }

    public function verifyToken(?string $token): bool
    {
        $activeToken = $this->findTokenByUser($this->security->getUser());

        if (
            $activeToken != $token
            || empty($activeToken)
            || empty($token)
        ) {
            return false;
        }

        return true;
    }

    private function hasTokenForUse(User $user): bool
    {
        $token = $this->findTokenByUser($user);

        if (empty($token)) {
            return false;
        }

        return true;
    }

    private function getTokenActive(array $tokens): ?string
    {
        $currentDate = new \DateTime();

        foreach ($tokens as $token) {
            if ($token->getExpiresAt() > $currentDate) {
                return $token->getToken();
            }
        }

        return null;
    }
}
