<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $product_name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $product_price = null;

    #[ORM\Column(length: 255)]
    private ?string $product_image_link = null;

    #[ORM\Column(length: 255)]
    private ?string $product_original_link = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->product_price;
    }

    public function setProductPrice(string $product_price): static
    {
        $this->product_price = $product_price;

        return $this;
    }

    public function getProductImageLink(): ?string
    {
        return $this->product_image_link;
    }

    public function setProductImageLink(string $product_image_link): static
    {
        $this->product_image_link = $product_image_link;

        return $this;
    }

    public function getProductOriginalLink(): ?string
    {
        return $this->product_original_link;
    }

    public function setProductOriginalLink(string $product_original_link): static
    {
        $this->product_original_link = $product_original_link;

        return $this;
    }
}
