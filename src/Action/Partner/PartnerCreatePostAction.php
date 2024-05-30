<?php

namespace App\Action\Partner;

use App\Domain\Service\Partner\PartnerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/v1/partner/create', name: 'partner.create', methods: ['POST'])]
class PartnerCreatePostAction
{
    public function __construct(
        private PartnerServiceInterface $partnerService
    )
    { }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse('TODO');
    }
}