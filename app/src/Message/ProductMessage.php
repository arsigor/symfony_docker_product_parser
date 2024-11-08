<?php

namespace App\Message;

final class ProductMessage
{
    private string $name;
    private float $price;
    private string $imageUrl;
    private string $productUrl;

    public function __construct(string $name, float $price, string $imageUrl, string $productUrl)
    {
        $this->name = $name;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->productUrl = $productUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getProductUrl(): string
    {
        return $this->productUrl;
    }
}
