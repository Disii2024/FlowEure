<?php

namespace App\Entity;

use App\Repository\AARepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AARepository::class)]
class AA
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
