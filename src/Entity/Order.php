<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_command = null;

    #[ORM\Column]
    private ?int $nbr_article = null;

    #[ORM\OneToMany(mappedBy: 'order_id', targetEntity: OrderTransition::class)]
    private Collection $orderTransitions;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?StatusCommande $status_commande_id = null;

    public function __construct()
    {
        $this->orderTransitions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->date_command;
    }

    public function setDateCommand(\DateTimeInterface $date_command): static
    {
        $this->date_command = $date_command;

        return $this;
    }

    public function getNbrArticle(): ?int
    {
        return $this->nbr_article;
    }

    public function setNbrArticle(int $nbr_article): static
    {
        $this->nbr_article = $nbr_article;

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
            $orderTransition->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderTransition(OrderTransition $orderTransition): static
    {
        if ($this->orderTransitions->removeElement($orderTransition)) {
            // set the owning side to null (unless already changed)
            if ($orderTransition->getOrderId() === $this) {
                $orderTransition->setOrderId(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getStatusCommandeId(): ?StatusCommande
    {
        return $this->status_commande_id;
    }

    public function setStatusCommandeId(?StatusCommande $status_commande_id): static
    {
        $this->status_commande_id = $status_commande_id;

        return $this;
    }

}
