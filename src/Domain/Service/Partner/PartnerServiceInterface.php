<?php

namespace App\Domain\Service\Partner;

use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;

interface PartnerServiceInterface
{
    public function createPartner(): ?Partner;
}