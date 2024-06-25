<?php

namespace App\Infrastructure\Repository\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class PartnerRepository extends ServiceEntityRepository implements PartnerRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct($registry, Partner::class);
    }

    public function findPartnerById(int $id): ?Partner
    {
        // TODO: Implement findPartnerById() method.
        return null;
    }


    public function createPartner(CreatePartnerDTO $partner): ?Partner
    {
        $query = <<<QUERY
            INSERT INTO partners.s_partner (
                nu_seq_id,
                des_trading_name,
                des_owner_name,
                des_document,
                mp_coverage_area,
                pt_address,
                dt_created_at,
                dt_updated_at
            ) VALUES (
                nextval('partners.s_partner_nu_seq_id_seq '),
                :tradingName,
                :ownerName,
                :document,
                ST_GeomFromText('MULTIPOLYGON(((30 20, 45 40, 10 40, 30 20)), ((15 5, 40 10, 10 20, 5 10, 15 5)))', 4326),
                ST_GeomFromText('POINT(30 10)', 4326),
                now(),
                now()
            );
        QUERY;

        $connection = $this->entityManager->getConnection();
        $statement = $connection->prepare($query);
        $statement->bindValue('tradingName', $partner->tradingName);
        $statement->bindValue('ownerName', $partner->ownerName);
        $statement->bindValue('document', $partner->document);
//        $statement->bindValue('coverageArea', $partner->coverageArea);
//        $statement->bindValue('address', $partner->address);

        $result = $statement->executeQuery();

        dd($result);
    }
}
