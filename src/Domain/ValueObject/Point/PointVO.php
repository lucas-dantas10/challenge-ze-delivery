<?php

namespace App\Domain\ValueObject\Point;

class PointVO
{
    public function __construct(
        private readonly object $pointData,
    ) { }

    public function getPointData(): object
    {
        return $this->pointData;
    }
}
