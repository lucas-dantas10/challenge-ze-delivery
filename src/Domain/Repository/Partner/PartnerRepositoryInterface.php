<?php

namespace App\Domain\Repository\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Entity\PartnerEntity\Partner;

interface PartnerRepositoryInterface
{
    public function findPartnerById(int $id): ?Partner;
    public function createPartner(CreatePartnerDTO $partner): ?Partner;
}
