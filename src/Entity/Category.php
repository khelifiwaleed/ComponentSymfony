<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:category:collection', 'read:collection']],
    denormalizationContext: ['groups' => ['write:collection']],
    operations: [
        new \ApiPlatform\Metadata\Get(
            normalizationContext: ['groups' => ['read:category:collection', 'read:collection']]
        ),
        new \ApiPlatform\Metadata\Post(
            denormalizationContext: ['groups' => ['write:category:collection', 'write:collection']]
        ),
        new \ApiPlatform\Metadata\Put(
            denormalizationContext: ['groups' => ['write:category:collection', 'write:collection']]
        ),
        new \ApiPlatform\Metadata\Patch(
            denormalizationContext: ['groups' => ['write:category:collection', 'write:collection']]
        )
    ]
)]
class Category extends Entity
{
    #[ORM\Column(name: 'type', length: 255, nullable: true)]
    #[Groups(['read:category:collection', 'write:category:collection'])]
    private ?string $type = null;

    #[ORM\Column(name: 'code', nullable: true)]
    #[Groups(['read:category:collection', 'write:category:collection'])]
    private ?int $code = null;

    #[ORM\Column(name: 'message', length: 255, nullable: true)]
    #[Groups(['read:category:collection', 'write:category:collection'])]
    private ?string $message = null;

    /**
     * @var Collection<int, Posts>
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Posts::class)]
    private Collection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): static
    {
        $this->code = $code;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Collection<int, Posts>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }
}
