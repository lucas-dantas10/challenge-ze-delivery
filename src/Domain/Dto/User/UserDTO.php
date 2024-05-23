<?php

namespace App\Domain\Dto\User;

use App\Domain\ValueObject\Point\PointVO;

class UserDTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly PointVO $address
    ) { }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function getAddress(): PointVO
    {
        return $this->address;
    }
}
