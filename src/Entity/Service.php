<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_service = null;

    #[ORM\Column]
    private ?float $price_supplement = null;

    #[ORM\OneToMany(mappedBy: 'service_id', targetEntity: OrderTransition::class)]
    private Collection $orderTransitions;

    public function __construct()
    {
        $this->orderTransitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameService(): ?string
    {
        return $this->name_service;
    }

    public function setNameService(string $name_service): static
    {
        $this->name_service = $name_service;

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
            $orderTransition->setServiceId($this);
        }

        return $this;
    }

    public function removeOrderTransition(OrderTransition $orderTransition): static
    {
        if ($this->orderTransitions->removeElement($orderTransition)) {
            // set the owning side to null (unless already changed)
            if ($orderTransition->getServiceId() === $this) {
                $orderTransition->setServiceId(null);
            }
        }

        return $this;
    }
}
