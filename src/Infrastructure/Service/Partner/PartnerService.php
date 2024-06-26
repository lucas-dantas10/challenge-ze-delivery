<?php

namespace App\Infrastructure\Service\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;
use App\Domain\Service\Partner\PartnerServiceInterface;

class PartnerService implements PartnerServiceInterface
{
    public function __construct(
        private PartnerRepositoryInterface $partnerRepository
    ) { }

    public function findPartnerById(int $id): ?array
    {
        return $this->partnerRepository->findPartnerById($id);
    }

    public function createPartner(CreatePartnerDTO $partner): ?array
    {
        return $this->partnerRepository->createPartner($partner);
    }
}
