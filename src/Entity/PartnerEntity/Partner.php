<?php

namespace App\Entity\PartnerEntity;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use CrEOF\Spatial\PHP\Types\Geometry\MultiPolygon;

class Partner
{
    private int $id;
    private string $tradingName;
    private string $ownerName;
    private string $document;
    private $coverageArea;
    private $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTradingName(): string
    {
        return $this->tradingName;
    }

    public function setTradingName(string $tradingName): void
    {
        $this->tradingName = $tradingName;
    }

    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    public function setOwnerName(string $ownerName): void
    {
        $this->ownerName = $ownerName;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function setDocument(string $document): void
    {
        $this->document = $document;
    }

    public function getCoverageArea(): \GEOSGeometry
    {
        return $this->coverageArea;
    }

    public function setCoverageArea(MultiPolygon $coverageArea): void
    {
        $this->coverageArea = $coverageArea;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress(Point $address): void
    {
        $this->address = $address;
    }
}
