<?php

namespace App\Domain\ValueObject\Point;

class PointVO
{
    public function __construct(
        private float $latitude,
        private float $longitude,
    ) {
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
