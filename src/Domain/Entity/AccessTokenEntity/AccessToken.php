<?php

namespace App\Domain\Entity\AccessTokenEntity;

use App\Domain\Entity\UserEntity\User;

class AccessToken
{
    private int $id;
    private User $user;
    private string $name;
    private string $token;
    private \DateTime $expiresAt;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTime $expires_at): void
    {
        $this->expiresAt = $expires_at;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->createdAt = $created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updatedAt = $updated_at;
    }
}