<?php

declare(strict_types=1);

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait EntityRepeatedInput
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(name: "created_at", type: "datetime", nullable: true)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(name: "updated_at", type: "datetime", nullable: true)]
    private \DateTimeInterface $updatedAt;

    public function __construct()
    {
<<<<<<< Updated upstream
        $this->createdAt = new \DateTime();
=======
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
>>>>>>> Stashed changes
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}