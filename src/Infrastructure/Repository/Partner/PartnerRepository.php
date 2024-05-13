<?php

namespace App\Infrastructure\Repository\Partner;

use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PartnerRepository extends ServiceEntityRepository implements PartnerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
    }

    public function findPartnerById(int $id): ?Partner
    {
        // TODO: Implement findPartnerById() method.
        return null;
    }
}
