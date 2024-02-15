<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups'=> ['articles:read']],
    operations: [
        new GetCollection(),
        new Get(),
    ]
    )]
#[ApiFilter(SearchFilter::class, properties:['name_a'=>'ipartial'])]

class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['articles:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['articles:read'])]
    private ?string $name_a = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['articles:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['articles:read'])]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'article_id', targetEntity: OrderTransition::class)]
    #[Groups(['articles:read'])]
    private Collection $orderTransitions;

    public function __construct()
    {
        $this->orderTransitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameA(): ?string
    {
        return $this->name_a;
    }

    public function setNameA(string $name_a): static
    {
        $this->name_a = $name_a;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, OrderTransition>
     */
    public function getOrderTransitions(): Collection
    {
        return $this->orderTransitions;
    }

    public function addOrderTransition(OrderTransition $orderTransition): static
    {
        if (!$this->orderTransitions->contains($orderTransition)) {
            $this->orderTransitions->add($orderTransition);
            $orderTransition->setArticleId($this);
        }

        return $this;
    }

    public function removeOrderTransition(OrderTransition $orderTransition): static
    {
        if ($this->orderTransitions->removeElement($orderTransition)) {
            // set the owning side to null (unless already changed)
            if ($orderTransition->getArticleId() === $this) {
                $orderTransition->setArticleId(null);
            }
        }

        return $this;
    }
}
