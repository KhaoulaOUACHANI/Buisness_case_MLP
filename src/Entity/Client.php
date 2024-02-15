<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource]
class Client extends User
{

    #[ORM\Column(length: 255)]
    private ?string $clientNumber = null;

    public function getClientNumber(): ?string
    {
        return $this->clientNumber;
    }

    public function setClientNumber(string $clientNumber): static
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }
}
