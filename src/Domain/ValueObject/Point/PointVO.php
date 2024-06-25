<?php

namespace App\Domain\ValueObject\Point;

class PointVO
{
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
    ) { }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function toPointData(): string
    {
        return sprintf('POINT(%f %f)', $this->longitude, $this->latitude);
    }
}
