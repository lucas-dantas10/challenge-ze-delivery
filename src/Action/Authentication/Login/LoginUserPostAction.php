<?php

namespace App\Action\Authentication\Login;

use App\Domain\Entity\UserEntity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route(path: '/api/v1/login', name: 'login_user', methods: ['POST'])]
class LoginUserPostAction
{
    public function __construct(
        private readonly
    )
    { }

    public function __invoke(#[CurrentUser] ?User $user): JsonResponse
    {
        if (is_null($user)) {
            return new JsonResponse([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'message' => 'user logged',
            'data' => $user,
            'status' => 200
        ], Response::HTTP_CREATED);
    }
}
