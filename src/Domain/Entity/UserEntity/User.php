<?php

namespace App\Domain\Entity\UserEntity;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private Point $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAddress(): Point
    {
        return $this->address;
    }

    public function setAddress(Point $address): void
    {
        $this->address = $address;
    }
}
