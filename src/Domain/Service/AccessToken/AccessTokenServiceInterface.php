<?php

namespace App\Domain\Service\AccessToken;

use App\Domain\Entity\UserEntity\User;

interface AccessTokenServiceInterface
{
    public function generateToken(User $userId): string;
}