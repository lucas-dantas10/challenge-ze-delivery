<?php

namespace App\Domain\Repository\Partner;

use App\Domain\Entity\PartnerEntity\Partner;

interface PartnerRepositoryInterface
{
    public function findPartnerById(int $id): ?Partner;
}
