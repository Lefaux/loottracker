<?php

namespace App\Command;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class TranslateCommand extends Command
{
    protected static $defaultName = 'app:translate';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(EntityManagerInterface $entityManager, ItemRepository $itemRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->itemRepository = $itemRepository;
    }

    protected function configure():void
    {
        $this->setDescription('Translates Item Names to german');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $itemsToTranslaste = $this->itemRepository->findBy(
            ['icon' => null],
            ['quality' => 'DESC'],
            1000
        );
        $progressBar = new ProgressBar($io, count($itemsToTranslaste));
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        foreach ($itemsToTranslaste as $index => $item) {
            $this->translateItem($item, $io);
            $progressBar->advance();
        }
        $io->success('Done');
    }

    private function translateItem(Item $item, OutputInterface $output): void
    {
        $classicData = file_get_contents('https://de.classic.wowhead.com/item=' . $item->getId() . '&xml');
        $crawlerToolTip = new Crawler($classicData);
        if (strpos($classicData, 'Item not found') !== false) {
            $output->writeln('item '. $item->getName() . ' not found in classic');
            return;
        }
        $crawler = new Crawler($classicData);
        $name = $crawler->filter('name');
        $icon = $crawler->filter('icon')->html();
        $json = $crawler->filter('json')->text();

        $dropData = json_decode('{' . $json . '}', true);
        if (isset($dropData['sourcemore'][0]['z'])) {
            $item->setZone((int)$dropData['sourcemore'][0]['z']);
        }

        $item->setIcon($icon);
        $item->setNameDe($name->html());
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }
}
