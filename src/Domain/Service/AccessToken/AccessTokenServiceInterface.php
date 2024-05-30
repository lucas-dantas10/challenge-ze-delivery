<?php

namespace App\Domain\Service\AccessToken;

use App\Domain\Entity\UserEntity\User;

interface AccessTokenServiceInterface
{
    public function findTokenByUser(User $user): ?string;
    public function generateToken(User $user): string;
    public function verifyToken(?string $token): bool;
}