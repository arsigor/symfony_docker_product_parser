<?php

namespace App\Command;

use App\Entity\Product;
use App\Message\ProductMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\MessageBusInterface;


#[AsCommand(
    name: 'app:parse-products',
    description: 'Add a short description for your command',
)]
class ParseProductsCommand extends Command
{
    private MessageBusInterface $bus;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ParameterBagInterface $params, MessageBusInterface $bus)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = HttpClient::create();
        $urls = ['https://epicentrk.ua/ua/shop/noutbuki/', 'https://epicentrk.ua/ua/shop/noutbuki/?PAGEN_1=2', 'https://epicentrk.ua/ua/shop/noutbuki/?PAGEN_1=3'];

        foreach ($urls as $url) {
            $response = $client->request('GET', $url);
            $crawler = new Crawler($response->getContent());

            $crawler->filterXPath('//div[@class="_eVPXSX"]')->each(function (Crawler $node) {

                $name = $node->filterXPath('.//h3[@itemprop="name"]/a')->attr('title');
                $price = (float) $node->filterXPath('.//div[@data-product-price-main]//data')->attr('value');
                $imageUrl = $node->filterXPath('.//img')->attr('src');
                $productUrl = $node->filterXPath('.//a')->attr('href');

                $product = new Product();
                $product->setProductName($name);
                $product->setProductPrice($price);
                $product->setProductImageLink($imageUrl);
                $product->setProductOriginalLink($productUrl);

                $this->entityManager->persist($product);

                $this->bus->dispatch(new ProductMessage($name, $price, $imageUrl, $productUrl));
            });
        }

        $this->entityManager->flush();

        $output->writeln('Products parsed and saved.');

        return Command::SUCCESS;
    }
}
