<?php

namespace App\Infrastructure\Repository\AccessToken;

use App\Domain\Entity\AccessTokenEntity\AccessToken;
use App\Domain\Entity\UserEntity\User;
use App\Domain\Repository\AccessToken\AccessTokenRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessTokenRepository extends ServiceEntityRepository implements AccessTokenRepositoryInterface
{
    private readonly AccessToken $accessToken;
    
    public function __construct(ManagerRegistry $registry)
    {
        $this->accessToken = new AccessToken();
        parent::__construct($registry, AccessToken::class);
    }

    public function createTokenForUser(User $user, string $token): AccessToken
    {
        $em = $this->getEntityManager();

        $expiredAt = (new \DateTime())->modify('+1 day');

        $this->accessToken->setUser($user);
        $this->accessToken->setName('login');
        $this->accessToken->setToken($token);
        $this->accessToken->setCreatedAt(new \DateTime());
        $this->accessToken->setExpiresAt($expiredAt);
        $this->accessToken->setUpdatedAt(new \DateTime());

        $em->persist($this->accessToken);
        $em->flush();

        return $this->accessToken;
    }

    public function findTokenByUser(User $user): ?array
    {
        return $this->findBy(['user' => $user->getId()]);
    }
}
