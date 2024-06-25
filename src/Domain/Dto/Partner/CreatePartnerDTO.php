<?php

namespace App\Domain\Dto\Partner;

use App\Domain\ValueObject\Point\PointVO;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreatePartnerDTO
{
    public function __construct(
        #[NotBlank(message: 'The field trading name is required')]
        #[Type('string')]
        public readonly string $tradingName,

        #[NotBlank(message: 'The field owner name is required')]
        #[Type('string')]
        public readonly string $ownerName,

        #[NotBlank(message: 'The field document is required')]
        #[Type('string')]
        public readonly string $document,

        #[NotBlank(message: 'This field coverage area is required')]
        #[Type('array')]
        public readonly array $coverageArea,

        #[NotBlank(message: 'This field address is required')]
        #[Type(PointVO::class)]
        public readonly PointVO $address,
    ) { }
}
