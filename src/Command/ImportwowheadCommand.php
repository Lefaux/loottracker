<?php

namespace App\Command;

use App\Entity\Item;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\SubCategoryRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class ImportwowheadCommand extends Command
{
    protected static $defaultName = 'app:importwowhead';

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var SubCategoryRepository
     */
    protected $subCategoryRepository;

    protected $maxItemId = 30000;

    public function __construct(
        EntityManagerInterface $entityManager,
        ItemRepository $itemRepository,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository
    ) {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Attempts to import all items from classic wowhead')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $lastImportedItem = 1529;
        $startAt = $this->findLastImportedItem();
        if ($startAt < $lastImportedItem) {
            $startAt = $lastImportedItem;
        }
        $output->writeln('Starting at '. $startAt);
//        $this->importItemFromWoWHead(7976, $output);
        while($startAt < $this->maxItemId) {
            $startAt++;
            try {
                $this->importItemFromWoWHead($startAt, $output);
            } catch (Exception $e) {
                $output->writeln('ERROR IN ITEM '. $startAt);
            }
        }


        $io->success('Done importing from wowhead');
    }

    private function findLastImportedItem(): int
    {
        return $this->itemRepository->findMaxImportedItem();
    }

    /**
     * @param int $itemId
     * @param OutputInterface $output
     * @throws Exception
     */
    private function importItemFromWoWHead(int $itemId, OutputInterface $output): void
    {
        $item = new Item();
        $item->setId($itemId);
        $liveData = file_get_contents('https://www.wowhead.com/item=' . $itemId . '&xml');
        $classicData = file_get_contents('https://classic.wowhead.com/item=' . $itemId . '&xml');
        $crawlerToolTip = new Crawler($classicData);
        if (strpos($liveData, 'Item not found') !== false) {
            $output->writeln('item '. $itemId . ' not found');
            return;
        }
        if (strpos($classicData, 'Item not found') !== false) {
            $output->writeln('item '. $itemId . ' not found in classic');
            return;
        }
        $crawler = new Crawler($liveData);
        $name = $crawler->filter('name');
        $output->writeln('['.$itemId.']-'.$name->html());

        $item->setName($name->html());


        // Try to find an error

        $toolTip = $crawlerToolTip->filter('htmlTooltip');
        $item->setRequiredLevel($this->setRequiredLevel($toolTip->html()));

        $level = $crawler->filter('level');
        $item->setItemLevel((int)$level->html());

        $quality = $crawler->filter('quality');
        $qualityValue = (int)$quality->attr('id');
        $item->setQuality($qualityValue);

        // Set main category
        $category = $crawler->filter('class');
        $categoryValue = (int)$category->attr('id');
        $item->setClassFromWH($categoryValue);
        $class = $this->categoryRepository->findOneBy([
            'identifier' => $categoryValue
        ]);
        // Set subcategory
        $subCategory = $crawler->filter('subclass');
        $subCategoryValue = (int)$subCategory->attr('id');
        $item->setSubClassFromWH($subCategoryValue);
        $subClass = $this->subCategoryRepository->findOneBy([
            'identifier' => $subCategoryValue,
            'parentClass' => $class->getId()
        ]);

        $item->setClass($class);
        $item->setSubClass($subClass);

        $item->setLastImport(new DateTime());
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }

    private function setRequiredLevel(string $toolTip): int
    {
        $reqLevel = 0;
        if(strpos($toolTip, '<!--rlvl-->') !== false) {
            $pattern = '/<!--rlvl-->(\d{1,2})</';
            preg_match_all($pattern, $toolTip, $matches, PREG_SET_ORDER);
            if (isset($matches[0][1])) {
                $reqLevel = (int)$matches[0][1];
            }
        }
        $pattern = '/Requires(.*)(Alchemy|Blacksmithing|Leatherworking|Tailoring|Enchanting|Engineering)<\/a> \((?P<TradeLevel>\d{1,3})/';
        preg_match_all($pattern, $toolTip, $matches, PREG_SET_ORDER);
        if (isset($matches[0]['TradeLevel'])) {
            $reqLevel = (int)$matches[0]['TradeLevel'];
        }
        return $reqLevel;
    }
}
