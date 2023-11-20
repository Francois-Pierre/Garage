<?php

namespace App\Entity;

use App\Repository\OpeningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningRepository::class)]
class Opening
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Hours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHours(): ?string
    {
        return $this->Hours;
    }

    public function setHours(?string $Hours): static
    {
        $this->Hours = $Hours;

        return $this;
    }
}
