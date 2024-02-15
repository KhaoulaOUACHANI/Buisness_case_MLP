<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['user' => User::class, 'client'=> Client::class])]
#[ApiResource]
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $firstname_u = null;

    #[ORM\Column(length: 255)]
    protected ?string $lastname_u = null;

    #[ORM\Column(length: 255)]
    protected ?string $mail_u = null;

    #[ORM\Column(length: 255)]
    protected ?string $password_u = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTimeInterface $birth_u = null;

    #[ORM\Column(length: 255)]
    protected ?string $adress_u = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?City $city_id = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Gender $gender_id = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstnameU(): ?string
    {
        return $this->firstname_u;
    }

    public function setFirstnameU(string $firstname_u): static
    {
        $this->firstname_u = $firstname_u;

        return $this;
    }

    public function getLastnameU(): ?string
    {
        return $this->lastname_u;
    }

    public function setLastnameU(string $lastname_u): static
    {
        $this->lastname_u = $lastname_u;

        return $this;
    }

    public function getMailU(): ?string
    {
        return $this->mail_u;
    }

    public function setMailU(string $mail_u): static
    {
        $this->mail_u = $mail_u;

        return $this;
    }

    public function getPasswordU(): ?string
    {
        return $this->password_u;
    }

    public function setPasswordU(string $password_u): static
    {
        $this->password_u = $password_u;

        return $this;
    }

    public function getBirthU(): ?\DateTimeInterface
    {
        return $this->birth_u;
    }

    public function setBirthU(\DateTimeInterface $birth_u): static
    {
        $this->birth_u = $birth_u;

        return $this;
    }

    public function getAdressU(): ?string
    {
        return $this->adress_u;
    }

    public function setAdressU(string $adress_u): static
    {
        $this->adress_u = $adress_u;

        return $this;
    }

    public function getCityId(): ?City
    {
        return $this->city_id;
    }

    public function setCityId(?City $city_id): static
    {
        $this->city_id = $city_id;

        return $this;
    }

    public function getGenderId(): ?Gender
    {
        return $this->gender_id;
    }

    public function setGenderId(?Gender $gender_id): static
    {
        $this->gender_id = $gender_id;

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
            $order->setUserId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUserId() === $this) {
                $order->setUserId(null);
            }
        }

        return $this;
    }
}
