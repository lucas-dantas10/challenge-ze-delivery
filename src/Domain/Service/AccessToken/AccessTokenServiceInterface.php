<?php

namespace App\Domain\Service\AccessToken;

use App\Domain\Entity\UserEntity\User;

interface AccessTokenServiceInterface
{
    public function findTokenByUser(User $user): array;
    public function generateToken(User $userId): string;
    public function verifyToken(string $token): bool;
}