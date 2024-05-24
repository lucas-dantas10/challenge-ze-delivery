<?php

namespace App\Infrastructure\Service\AccessToken;

use App\Domain\Entity\AccessTokenEntity\AccessToken;
use App\Domain\Entity\UserEntity\User;
use App\Domain\Repository\AccessToken\AccessTokenRepositoryInterface;
use App\Domain\Service\AccessToken\AccessTokenServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class AccessTokenService implements AccessTokenServiceInterface
{
    public function __construct(
        private readonly AccessTokenRepositoryInterface $accessTokenRepository,
        private readonly EntityManagerInterface $entityManager
    )
    { }

    public function generateToken(User $user): string
    {
        try {
            $this->entityManager->beginTransaction();

            if ($this->hasTokenForUse($user)) {
                $tokensExistent = $this->findTokenByUser($user);

                $activeToken = $this->getTokenActive($tokensExistent);

                return $activeToken;
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

    public function findTokenByUser(User $user): array
    {
        return $this->accessTokenRepository->findTokenByUser($user);
    }

    public function verifyToken(string $token): bool
    {
        // TODO: verify if token is valid
        return false;
    }

    private function hasTokenForUse(User $user): bool
    {
        $tokens = $this->findTokenByUser($user);

        $token = $this->getTokenActive($tokens);

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
