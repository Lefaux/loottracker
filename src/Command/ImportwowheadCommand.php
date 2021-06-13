<?php

namespace App\Command;

use App\Entity\Item;
use App\Entity\Zone;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\SubCategoryRepository;
use App\Repository\ZoneRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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

    protected $maxItemId = 55000;

    /**
     * @var ZoneRepository
     */
    private $zoneRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ItemRepository $itemRepository,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository,
        ZoneRepository $zoneRepository
    ) {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->zoneRepository = $zoneRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Attempts to import all items from classic wowhead')
            ->addOption('start', 's', InputOption::VALUE_OPTIONAL, 'Which item ID to start with importing', 1)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $startAt = (int)$input->getOption('start');
        $progressSection = $output->section();
        $outputSection = $output->section();
        $progressBar = new ProgressBar($progressSection);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->setMaxSteps($this->maxItemId);
        $output->writeln('Starting at '. $startAt);
        $progressBar->setProgress($startAt);
        while($startAt < $this->maxItemId) {
            $startAt++;
//            try {
                $this->importItemFromWoWHead($startAt, $outputSection);
//            } catch (Exception $e) {
//                $output->writeln('ERROR IN ITEM '. $startAt);
//            }
            $progressBar->advance(1);
        }


        $io->success('Done importing from wowhead');
    }

    /**
     * @param int $itemId
     * @param OutputInterface $output
     * @throws Exception
     */
    private function importItemFromWoWHead(int $itemId, OutputInterface $output): void
    {
        $item = $this->itemRepository->find($itemId);
        if (!$item) {
            $dummyClass = $this->categoryRepository->find(1);
            $dummySubClass = $this->subCategoryRepository->find(1);
            $item = new Item();
            $item->setZone(null);
            $item->setClass(null);
            $item->setHidden(false);
            $item->setLastImport(new DateTime());
            $item->setId($itemId);
            $item->setItemLevel(0);
            $item->setRequiredLevel(0);
            $item->setQuality(-1);
            $item->setClassFromWH(-1000);
            $item->setSubClassFromWH(-1000);
            $item->setClass($dummyClass);
            $item->setSubClass($dummySubClass);
        } else {
            $today = new DateTime();
            if ($item->getLastImport()) {
                $interval = $item->getLastImport()->diff($today);
                if ($interval->days < 7) {
                    $output->overwrite('item '. $itemId . ' imported recently');
                    return;
                }
            }
        }
        $liveData = file_get_contents('https://www.wowhead.com/item=' . $itemId . '&xml');
        if (strpos($liveData, 'Item not found') !== false) {
            $output->overwrite('item '. $itemId . ' not found');
            $item->setName('not found');
            $this->entityManager->persist($item);
            $this->entityManager->flush();
            sleep(1);
            return;
        }
        $classicData = file_get_contents('https://tbc.wowhead.com/item=' . $itemId . '&xml');
        $crawlerToolTip = new Crawler($classicData);
        if (strpos($classicData, 'Item not found') !== false) {
            $output->overwrite('item '. $itemId . ' not found in classic');
            $item->setName('not found in classic');
            $this->entityManager->persist($item);
            $this->entityManager->flush();
            sleep(1);
            return;
        }
        $crawler = new Crawler($classicData);
        $name = $crawler->filter('name');

        $item->setName($name->html());

        $germanData = file_get_contents('https://de.tbc.wowhead.com/item=' . $itemId . '&xml');
        $germanCrawler = new Crawler($germanData);
        $germanName = $germanCrawler->filter('name');
        $item->setNameDe($germanName->html());



        // Try to find an error

        $toolTip = $crawlerToolTip->filter('htmlTooltip');
        $item->setRequiredLevel($this->setRequiredLevel($toolTip->html()));

        $level = $crawler->filter('level');
        $item->setItemLevel((int)$level->html());

        $icon = $crawler->filter('icon');
        $item->setIcon($icon->html());

        $quality = $crawler->filter('quality');
        $qualityValue = (int)$quality->attr('id');
        $item->setQuality($qualityValue);

        $inventorySlot = $crawler->filter('inventorySlot');
        $inventorySlotValue = (int)$inventorySlot->attr('id');
        $item->setInventorySlot($inventorySlotValue);

        $jsonRaw = $crawler->filter('json');
        $json = json_decode('{' . $jsonRaw->html() .'}', true);
        if (isset($json['sourcemore'][0]['z']) && (strpos($jsonRaw->html(), 'sourcemore') !== false)) {
            $zone = $this->findOrInsertZone((int)$json['sourcemore'][0]['z']);
        } else {
            $zone = $this->zoneRepository->find(0);
        }
        $item->setZone($zone);

        // Set main category
        $category = $crawler->filter('class');
        $categoryValue = (int)$category->attr('id');
        $item->setClassFromWH($categoryValue);
        $class = $this->categoryRepository->findOneBy([
            'identifier' => $categoryValue
        ]);
        if ($class === null) {
            throw new RuntimeException('No entry found for class "' . $categoryValue . '"');
        }
        // Set subcategory
        $subCategory = $crawler->filter('subclass');
        $subCategoryValue = (int)$subCategory->attr('id');
        $item->setSubClassFromWH($subCategoryValue);
        $subClass = $this->subCategoryRepository->findOneBy([
            'identifier' => $subCategoryValue,
            'parentClass' => $class->getId()
        ]);
        if ($subClass === null) {
            throw new RuntimeException('No entry found for class "' . $categoryValue . '"');
        }

        $item->setClass($class);
        $item->setSubClass($subClass);

        if ($item->getQuality() < 3 || $item->getItemLevel() < 88) {
            $item->setHidden(true);
        }

        $output->overwrite(date('d.m.Y h:i:s') . ' ' .$name->html());

        $item->setHidden(false);
        $item->setLastImport(new DateTime());
        $this->entityManager->persist($item);
        $this->entityManager->flush();
        sleep(1);
    }

    private function findOrInsertZone(int $zoneId): Zone
    {
        $markup = file_get_contents('https://tbc.wowhead.com/zone=' . $zoneId);
        $zoneName = $this->extractZoneName($markup);
        $markup = file_get_contents('https://de.tbc.wowhead.com/zone=' . $zoneId);
        $zoneNameDe = $this->extractZoneName($markup);
        $zone = $this->zoneRepository->find($zoneId);
        if ($zone === null) {
            $zone = new Zone();
            $zone->setId($zoneId);
            $zone->setName($zoneName);
            $zone->setDe($zoneNameDe);
            $this->entityManager->persist($zone);
            $this->entityManager->flush();
            $zone = $this->zoneRepository->find($zoneId);
        }
        return $zone;
    }

    private function extractZoneName(string $markup): string
    {
        $crawler = new Crawler($markup);
        $titleTag = $crawler->filter('title')->text();
        $re = '/(.*)\s-\sZone/mU';
        preg_match_all($re, $titleTag, $matches, PREG_SET_ORDER, 0);
        if (isset($matches[0][1])) {
            return trim($matches[0][1]);
        }
        return '-';
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
