<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;


#[ORM\Entity(repositoryClass: PostsRepository::class)]
#[ApiResource(
    paginationClientItemsPerPage: true,
    paginationItemsPerPage:5,
    paginationMaximumItemsPerPage:5,
    normalizationContext: ['groups' => ['read:posts:collection', 'read:collection']],
    denormalizationContext: ['groups' => ['write:posts:collection', 'write:collection']],
    operations: [
        new \ApiPlatform\Metadata\Get(
            normalizationContext: ['groups' => [
                'read:posts:collection', 'read:category:collection', 'read:collection'
            ]]
        ),
        new \ApiPlatform\Metadata\GetCollection(
            normalizationContext: ['groups' => [
                'read:posts:collection', 'read:category:collection', 'read:collection'
            ]]
        ),
        new \ApiPlatform\Metadata\Post(
            denormalizationContext: ['groups' => ['write:posts:collection', 'write:collection']]
        ),
        new \ApiPlatform\Metadata\Put(
            denormalizationContext: ['groups' => ['write:posts:collection', 'write:collection']]
        ),
        new \ApiPlatform\Metadata\Patch(
            denormalizationContext: ['groups' => ['write:posts:collection', 'write:collection']]
        ),
        new \ApiPlatform\Metadata\Delete(
            denormalizationContext: ['groups' => ['write:posts:collection', 'write:collection']]
        )
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['titel' => 'partial', 'id' => 'exact'])]
#[ApiFilter(ExistsFilter::class, properties: ['id'])]
#[ApiFilter(OrderFilter::class, properties: ['titel', 'createdAt'])]

class Posts extends Entity
{
    #[ORM\Column(name: 'titel', length: 255, nullable: true)]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le texte doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le texte ne peut pas dépasser {{ limit }} caractères.'
    )]
    #[Groups(['read:posts:collection', 'write:posts:collection'])]
    private ?string $titel = null;

    #[ORM\Column(name: 'description', type: Types::TEXT, nullable: true)]
    #[Groups(['read:posts:collection', 'write:posts:collection'])]
    private ?string $description = null;

    #[ORM\Column(name: 'url', type: Types::TEXT, nullable: true)]
    #[Groups(['read:posts:collection', 'write:posts:collection'])]
    private ?string $url = null;

    #[ORM\Column(name: 'img_url', type: Types::TEXT, nullable: true)]
    #[Groups(['read:posts:collection', 'write:posts:collection'])]
    private ?string $imgUrl = null;

    /**
     * @var Category
     */
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'posts', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:posts:collection', 'write:posts:collection'])]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(?string $titel): static
    {
        $this->titel = $titel;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;
        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(?string $imgUrl): static
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;
        return $this;
    }
}
