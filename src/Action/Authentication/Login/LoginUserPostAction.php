<?php

namespace App\Action\Authentication\Login;

use App\Domain\Entity\UserEntity\User;
use App\Domain\Service\Login\LoginServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/v1/login', name: 'login_user', methods: ['POST'])]
readonly class LoginUserPostAction
{
    public function __construct(
        private LoginServiceInterface $loginService,
    )
    { }

    public function __invoke(#[CurrentUser] ?User $user): JsonResponse
    {
        return $this->loginService->login($user);
    }
}
