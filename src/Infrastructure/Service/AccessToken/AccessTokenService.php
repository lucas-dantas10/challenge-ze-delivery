<?php

namespace App\Infrastructure\Service\AccessToken;

use App\Domain\Entity\UserEntity\User;
use App\Domain\Repository\AccessToken\AccessTokenRepositoryInterface;
use App\Domain\Service\AccessToken\AccessTokenServiceInterface;

class AccessTokenService implements AccessTokenServiceInterface
{
    public function __construct(
        private readonly AccessTokenRepositoryInterface $accessTokenRepository,
    )
    { }

    public function generateToken(User $user): string
    {
        $tokenMounted = hash('sha512', random_bytes(32));

        $this->accessTokenRepository->createTokenForUser($user, $tokenMounted);

        return $tokenMounted;
    }
}