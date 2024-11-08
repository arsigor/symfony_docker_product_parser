<?php

namespace App\MessageHandler;

use App\Message\ProductMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ProductMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private string $csvFilePath;

    public function __construct(EntityManagerInterface $entityManager, ParameterBagInterface $params)
    {
        $this->entityManager = $entityManager;
        $this->csvFilePath = $params->get('kernel.project_dir') . '/csv_data/products.csv';
    }

    public function __invoke(ProductMessage $message)
    {
        $this->writeToCsv([
            'name' => $message->getName(),
            'price' => $message->getPrice(),
            'image_url' => $message->getImageUrl(),
            'product_url' => $message->getProductUrl(),
        ]);
    }

    private function writeToCsv(array $data): void
    {
        $file = fopen($this->csvFilePath, 'a');
        if ($file) {
            fputcsv($file, $data);
            fclose($file);
        }
    }
}
