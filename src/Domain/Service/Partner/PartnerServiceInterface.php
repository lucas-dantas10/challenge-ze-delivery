<?php

namespace App\Domain\Service\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;

interface PartnerServiceInterface
{
    public function createPartner(CreatePartnerDTO $partner): ?array;
}