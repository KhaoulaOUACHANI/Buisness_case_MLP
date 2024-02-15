<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderTransitionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderTransitionRepository::class)]
#[ApiResource]
class OrderTransition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['articles:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['articles:read'])]
    private ?float $total_price = null;

    #[ORM\ManyToOne(inversedBy: 'orderTransitions')]
    #[Groups(['articles:read'])]
    private ?Matter $matter_id = null;

    #[ORM\ManyToOne(inversedBy: 'orderTransitions')]
    #[Groups(['articles:read'])]
    private ?Service $service_id = null;

    #[ORM\ManyToOne(inversedBy: 'orderTransitions')]
    private ?Article $article_id = null;

    #[ORM\ManyToOne(inversedBy: 'orderTransitions')]
    #[Groups(['articles:read'])]
    private ?Order $order_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getMatterId(): ?Matter
    {
        return $this->matter_id;
    }

    public function setMatterId(?Matter $matter_id): static
    {
        $this->matter_id = $matter_id;

        return $this;
    }

    public function getServiceId(): ?Service
    {
        return $this->service_id;
    }

    public function setServiceId(?Service $service_id): static
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getArticleId(): ?Article
    {
        return $this->article_id;
    }

    public function setArticleId(?Article $article_id): static
    {
        $this->article_id = $article_id;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): static
    {
        $this->order_id = $order_id;

        return $this;
    }
}
