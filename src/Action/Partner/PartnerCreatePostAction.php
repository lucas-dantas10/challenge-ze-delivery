<?php

namespace App\Action\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Service\Partner\PartnerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/api/v1/partner/create', name: 'partner.create', methods: ['POST'])]
class PartnerCreatePostAction
{
    public function __construct(
        private readonly PartnerServiceInterface $partnerService,
        private readonly SerializerInterface $serializer
    )
    { }

    public function __invoke(#[MapRequestPayload] CreatePartnerDTO $partner): JsonResponse
    {
        return $this->partnerService->createPartner($partner);
    }
}
