<?php

namespace App\Infrastructure\Service\Partner;

use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;
use App\Domain\Service\Partner\PartnerServiceInterface;

class PartnerService implements PartnerServiceInterface
{
    public function __construct(
        private PartnerRepositoryInterface $partnerRepository
    )
    { }

    public function createPartner(): ?Partner
    {
        // TODO: Implement createPartner() method.
        return null;
    }
}