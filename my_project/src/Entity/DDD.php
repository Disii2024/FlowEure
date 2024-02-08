<?php

namespace App\Entity;

use App\Repository\DDDRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DDDRepository::class)]
class DDD
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $aa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAa(): ?float
    {
        return $this->aa;
    }

    public function setAa(float $aa): static
    {
        $this->aa = $aa;

        return $this;
    }
}
