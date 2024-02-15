<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StatusCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusCommandeRepository::class)]
#[ApiResource]
class StatusCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status_commande = null;

    #[ORM\OneToMany(mappedBy: 'status_commande_id', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusCommande(): ?string
    {
        return $this->status_commande;
    }

    public function setStatusCommande(string $status_commande): static
    {
        $this->status_commande = $status_commande;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setStatusCommandeId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStatusCommandeId() === $this) {
                $order->setStatusCommandeId(null);
            }
        }

        return $this;
    }
}
