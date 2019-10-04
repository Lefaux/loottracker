<?php

namespace App\Command;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class UpdateSlotsCommand extends Command
{
    protected static $defaultName = 'app:update-slots';
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

    protected function configure()
    {
        $this->setDescription('sets inv slots for items');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $itemsWithNoSlot = $this->itemRepository->findBy(
            [
                'inventorySlot' => null,
            ],
            ['quality' => 'DESC'],
            500
        );
        $progressBar = new ProgressBar($io, count($itemsWithNoSlot));
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        foreach ($itemsWithNoSlot as $index => $item) {
            $this->translateItem($item, $io);
            $progressBar->advance();
        }
        $io->success('Done');
    }

    private function translateItem(Item $item, OutputInterface $output): void
    {
        $classicData = file_get_contents('https://classic.wowhead.com/item=' . $item->getId() . '&xml');
        $crawlerToolTip = new Crawler($classicData);
        if (strpos($classicData, 'Item not found') !== false) {
            $output->writeln('item '. $item->getName() . ' not found in classic');
            return;
        }
        $crawler = new Crawler($classicData);
        $slot = $crawler->filter('inventorySlot');

        $slotId = $slot->attr('id');

        $item->setInventorySlot((int)$slotId);
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }
}
