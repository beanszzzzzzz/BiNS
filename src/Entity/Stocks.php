<?php

namespace App\Entity;

use App\Repository\StocksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StocksRepository::class)]
class Stocks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAdded = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeImmutable
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeImmutable $dateAdded): static
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
