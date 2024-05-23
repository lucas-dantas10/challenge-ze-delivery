<?php

namespace App\Domain\Service\Login;

use App\Domain\Entity\UserEntity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

interface LoginServiceInterface
{
    public function login(User $user): JsonResponse;
}   
