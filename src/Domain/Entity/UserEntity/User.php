<?php

namespace App\Domain\Entity\UserEntity;

//use CrEOF\Spatial\PHP\Types\Geometry\Point;
use App\Domain\Entity\AccessTokenEntity\AccessToken;
use App\Domain\ValueObject\Point\PointVO as Point;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private Point $address;
    private ?Collection $accessTokens;
    private \DateTime $createdAt;
    private ?\DateTime $updatedAt;

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

    public function getAccessTokens(): ?Collection
    {
        return $this->accessTokens;
    }

    public function setAccessTokens(AccessToken $accessTokens): self
    {
        $this->accessTokens = $accessTokens;
        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
