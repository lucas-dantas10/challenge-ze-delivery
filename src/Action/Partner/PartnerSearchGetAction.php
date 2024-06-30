<?php 

namespace App\Action\Partner;

use App\Domain\Service\Partner\PartnerServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/v1/partner/{id}', name: 'partner.search', methods:["GET"])]
class PartnerSearchGetAction 
{
    public function __construct(
        private readonly PartnerServiceInterface $partnerService,
    )
    { }

    public function __invoke(int $id): JsonResponse 
    {
        $partner = $this->partnerService->findPartnerById($id);

        if (empty($partner)) {
            return new JsonResponse([
                'message' => 'Parceiro não encontrado!',
                'status' => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }
        
        return new JsonResponse([
            'partner' => $partner,
            'status' => Response::HTTP_FOUND
        ], Response::HTTP_FOUND);
    }
}
