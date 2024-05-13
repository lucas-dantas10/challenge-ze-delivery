<?php

namespace App\Domain\Entity\UserEntity;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class User implements PasswordAuthenticatedUserInterface
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

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getAddress(): Point
    {
        return $this->address;
    }

    public function setAddress(Point $address): self
    {
        $this->address = $address;
        return $this;
    }
}
