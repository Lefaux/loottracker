<?php

namespace App\Command;

use App\Repository\ItemRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ProcessIconsCommand extends Command
{
    protected static $defaultName = 'app:process-icons';
    /**
     * @var ItemRepository
     */
    private $itemRepository;
    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(ItemRepository $itemRepository, ParameterBagInterface $params)
    {
        parent::__construct();
        $this->itemRepository = $itemRepository;
        $this->params = $params;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Processes WoW icon-pack icons into grayscale')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $items = $this->itemRepository->findDistinctIcons();

        $progressBar = new ProgressBar($io);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');
        $progressBar->setMaxSteps(count($items));
        foreach ($items as $item) {
            if ($item['icon'] && $item['icon'] !== 'BAD_GATEWAY') {
                $this->processIcon($item['icon']);
                $progressBar->advance();
            }
        }
        $io->success('Done processing icons');
    }

    private function processIcon(string $name): void
    {
        $finalFilename = $this->params->get('kernel.project_dir') . '/public/assets/icons/items/' . $name . '.png';
        if (!file_exists($finalFilename)) {
            $originalIcon = imagecreatefromjpeg('https://wow.zamimg.com/images/wow/icons/large/' . $name . '.jpg');
            imagefilter($originalIcon, IMG_FILTER_GRAYSCALE);
//            imagefilter($originalIcon, IMG_FILTER_CONTRAST, -20);
            imagefilter($originalIcon, IMG_FILTER_BRIGHTNESS, 100);

            $iconSize = 18;
            $thumb = imagecreatetruecolor($iconSize, $iconSize);
            imagecopyresampled($thumb, $originalIcon, 0, 0, 0, 0, $iconSize, $iconSize, 56, 56);

            imagepng($thumb, $finalFilename);
            imagedestroy($originalIcon);
            imagedestroy($thumb);
        }
    }
}
