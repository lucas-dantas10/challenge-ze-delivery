<?php

namespace App\Domain\ValueObject\Point;

final readonly class PointVO
{
    public function __construct(
        private float $latitude,
        private float $longitude,
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

    public function toArray(): array
    {
        return [
            $this->latitude,
            $this->longitude
        ];
    }

    public function toJson(): string
    {
        $point = [
            'type' => 'Point',
            'coordinates' => [
                $this->latitude,
                $this->longitude
            ],
        ];

        return json_encode($point);
    }
}
