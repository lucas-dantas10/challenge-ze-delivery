<?php

namespace App\Infrastructure\Security\Token;

use App\Domain\Service\AccessToken\AccessTokenServiceInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class TokenAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly AccessTokenServiceInterface $accessTokenService,
        private readonly Security $security,
    )
    { }

    public function supports(Request $request): ?bool
    {
        if (str_starts_with($request->getPathInfo(), '/api/v1/login')) {
            return false;
        }

        return str_starts_with($request->getPathInfo(), '/api/v1');
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('Authorization');

        if (!$this->accessTokenService->verifyToken($apiToken)) {
            throw new AuthenticationException('Missing authorization header', Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->security->getUser();

        return new SelfValidatingPassport(new UserBadge($user->getEmail()));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?JsonResponse
    {
        $data = [
            'message' => 'Authentication failed',
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}
