<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'api_product', methods: ['GET'])]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();

        $data = array_map(function($product) {
            return [
                'id' => $product->getId(),
                'product_name' => $product->getProductName(),
                'product_price' => $product->getProductPrice(),
                'product_image_link' => $product->getProductImageLink(),
                'product_original_link' => $product->getProductOriginalLink(),
            ];
        }, $products);

        return $this->json($data);
    }
}
