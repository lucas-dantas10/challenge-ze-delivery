<?php

namespace App\Infrastructure\Repository\Partner;

use App\Domain\Dto\Partner\CreatePartnerDTO;
use App\Domain\Entity\PartnerEntity\Partner;
use App\Domain\Repository\Partner\PartnerRepositoryInterface;
use App\Domain\ValueObject\Point\PointVO;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPolygon;
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
        $connection = $this->entityManager->getConnection();
        $connection->beginTransaction();

        try {
            $pointData = $partner->address->toPointData();
            $multipolygonData = new MultiPolygon($partner->coverageArea);
            $multipolygonFormatted = sprintf("MULTIPOLYGON (%s)", $multipolygonData->__toString());

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
                    nextval('partners.s_partner_nu_seq_id_seq'),
                    :tradingName,
                    :ownerName,
                    :document,
                    st_astext(:coverageArea),
                    st_astext(:address),
                    now(),
                    now()
                );
            QUERY;

            $statement = $connection->prepare($query);
            $statement->bindValue('tradingName', $partner->tradingName);
            $statement->bindValue('ownerName', $partner->ownerName);
            $statement->bindValue('document', $partner->document);
            $statement->bindValue('coverageArea', $multipolygonFormatted);
            $statement->bindValue('address', $pointData);

            $statement->executeQuery()->fetchAssociative();

            $connection->commit();
        } catch (\Throwable $err) {
            $connection->rollBack();
            return null;
        }

        $partnerId = current($connection->fetchFirstColumn("SELECT CURRVAL('partners.s_partner_nu_seq_id_seq')"));

        return $this->findPartnerById($partnerId) ?? null;
    }
}
