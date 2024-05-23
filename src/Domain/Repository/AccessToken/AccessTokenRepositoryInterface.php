<?php

namespace App\Domain\Repository\AccessToken;

use App\Domain\Entity\AccessTokenEntity\AccessToken;
use App\Domain\Entity\UserEntity\User;

interface AccessTokenRepositoryInterface
{
    public function createTokenForUser(User $user, string $token): AccessToken;
}
