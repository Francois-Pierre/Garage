<?php

namespace App\Entity;

use App\Repository\LetterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LetterRepository::class)]
class Letter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\Column(length: 50)]
    private ?string $Mail = null;

    #[ORM\Column]
    private ?int $Phone = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): static
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): static
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): static
    {
        $this->Text = $Text;

        return $this;
    }
}
