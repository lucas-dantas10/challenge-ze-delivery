<?php

namespace App\Infrastructure\Service\Login;

use App\Domain\Dto\User\UserDTO;
use App\Domain\Entity\UserEntity\User;
use App\Domain\Service\Login\LoginServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class LoginService implements LoginServiceInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    )
    { }

    public function login(?User $user): JsonResponse
    {
        if (is_null($user)) {
            return new JsonResponse([
                'message' => 'missing credentials',
                'status' => 401,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $userDto = new UserDTO($user->getName(), $user->getEmail(), $user->getAddress());

        $user = $this->serializer->serialize($userDto, 'json');

        return new JsonResponse([
            'message' => 'user logged',
            'user' => json_decode($user, true),
            'token' => '',
            'status' => 200
        ], Response::HTTP_CREATED);
    }
}
