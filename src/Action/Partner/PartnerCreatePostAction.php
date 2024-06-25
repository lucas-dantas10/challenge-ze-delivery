<?php

namespace App\Action\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Service\Partner\PartnerServiceInterface;
use App\Domain\Exception\Partner\PartnerNotCreatedInterface;
use App\Domain\ValueObject\Point\PointVO;
use App\Infrastructure\Exception\Partner\PartnerNotCreated;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/api/v1/partner/create', name: 'partner.create', methods: ['POST'])]
class PartnerCreatePostAction
{
    public function __construct(
        private readonly PartnerServiceInterface $partnerService,
        private readonly SerializerInterface $serializer,
    )
    { }

    public function __invoke(#[MapRequestPayload] CreatePartnerDTO $partner): JsonResponse
    {
        try {
            $partner = $this->partnerService->createPartner($partner);

            if (empty($partner)) {
                throw new PartnerNotCreated();
            }

            return new JsonResponse($this->serializer->serialize($partner, 'json'));
        } catch (PartnerNotCreatedInterface $err) {
            return new JsonResponse([
                'message' => PartnerNotCreated::getMessageError(),
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $err) {
            return new JsonResponse([
                'message' => 'Ocorreu um erro!',
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
