<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatterRepository::class)]
#[ApiResource]
class Matter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_matter = null;

    #[ORM\Column]
    private ?float $price_supplement = null;

    #[ORM\OneToMany(mappedBy: 'matter_id', targetEntity: OrderTransition::class)]
    private Collection $orderTransitions;

    public function __construct()
    {
        $this->orderTransitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMatter(): ?string
    {
        return $this->name_matter;
    }

    public function setNameMatter(string $name_matter): static
    {
        $this->name_matter = $name_matter;

        return $this;
    }

    public function getPriceSupplement(): ?float
    {
        return $this->price_supplement;
    }

    public function setPriceSupplement(float $price_supplement): static
    {
        $this->price_supplement = $price_supplement;

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
            $orderTransition->setMatterId($this);
        }

        return $this;
    }

    public function removeOrderTransition(OrderTransition $orderTransition): static
    {
        if ($this->orderTransitions->removeElement($orderTransition)) {
            // set the owning side to null (unless already changed)
            if ($orderTransition->getMatterId() === $this) {
                $orderTransition->setMatterId(null);
            }
        }

        return $this;
    }
}
