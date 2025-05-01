<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource]

class Customer extends Entity
{
    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $firstName = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $lastName = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(type: "string", length: 15, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Regex("/^\+[1-9]{1}[0-9]{3,14}$/")]  // Format international
    private ?string $phoneNumber = null;

    #[ORM\Column(name: "is_active", type: "boolean", length: 255, nullable: true)]
    private bool $isActive = true;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }


    public function getIsActive(): bool
    {
            return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

}
