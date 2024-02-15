<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_c = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameC(): ?string
    {
        return $this->name_c;
    }

    public function setNameC(string $name_c): static
    {
        $this->name_c = $name_c;

        return $this;
    }
}
