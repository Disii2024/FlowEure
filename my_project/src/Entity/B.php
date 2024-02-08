<?php

namespace App\Entity;

use App\Repository\BRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BRepository::class)]
class B
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
