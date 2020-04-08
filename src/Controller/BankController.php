<?php

namespace App\Controller;

use App\Entity\BankItem;
use App\Repository\BankItemRepository;
use App\Repository\ItemRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankController extends AbstractController
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;
    /**
     * @var BankItemRepository
     */
    private $bankRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ItemRepository $itemRepository, BankItemRepository $bankItemRepository, EntityManagerInterface $entityManager)
    {
        $this->itemRepository = $itemRepository;
        $this->bankRepository = $bankItemRepository;
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/roster/bank", name="bank")
     */
    public function indexAction(): Response
    {
        $bankItems = $this->bankRepository->listBankSlots();

        $dir = $this->getParameter('kernel.project_dir') . '/var';
        $lastUpdate = filemtime($dir . '/guild-bank-gold.txt');
        $gold = file_get_contents($dir . '/guild-bank-gold.txt');
        return $this->render('bank/index.html.twig', [
            'bankItems' => $bankItems,
            'gold' => $gold,
            'lastUpdate' => $lastUpdate
        ]);
    }

    /**
     * @Route("/upload/bank", name="bank_upload")
     * @param Request $request
     * @return Response
     */
    public function uploadAction(Request $request): Response
    {
        if ($request->request->has('bankstring')) {
            $bankString = $request->request->get('bankstring');
            $bankArray = $this->parseBankString($bankString);
            $this->insertBankData($bankArray);
            $this->addFlash('success', 'Bank data uploaded');
        }
        return $this->render('bank/update.html.twig', [
            'controller_name' => 'UPLOAD',
        ]);
    }

    private function parseBankString(string $bankString): array
    {
        $bankArray = [
            'items' => []
        ];
        $lines = explode(chr(10), trim($bankString));
        $gold = array_pop($lines);
        $pattern = '/(?<gold>[\d]+)g/m';
        preg_match_all($pattern, $gold, $matches, PREG_SET_ORDER, 0);
        if (isset($matches[0]['gold']) && is_numeric($matches[0]['gold'])) {
            $bankArray['gold'] = (int)$matches[0]['gold'];
        }

        $exportDate = array_pop($lines);
        $exportDateTime = DateTime::createFromFormat('D M j H:i:s Y', trim($exportDate));
        foreach ($lines as $lineNumber => $line) {
            if (trim($line) !== '') {
                $lineParts = explode(chr(9), $line);
                if (count($lineParts) === 2) {
                    $item = $this->itemRepository->find($lineParts[0]);
                    if ($item) {
                        $amount = (int)$lineParts[1];
                        if (array_key_exists($item->getId(), $bankArray['items'])) {
                            $amount = $bankArray['items'][$item->getId()]['amount'] + (int)$lineParts[1];
                        }
                        $bankArray['items'][$item->getId()] = [
                            'item' => $item,
                            'amount' => $amount
                        ];
                    }
                }
            }
        }
        $bankArray['exported'] = $exportDateTime;
        return $bankArray;
    }

    private function insertBankData(array $bankArray): void
    {
        $dir = $this->getParameter('kernel.project_dir') . '/var';
        file_put_contents($dir . '/guild-bank-gold.txt', $bankArray['gold']);
        $this->bankRepository->removeData();
        foreach ($bankArray['items'] as $item) {
            $bankItem = new BankItem();
            $bankItem->setItem($item['item']);
            $bankItem->setAmount($item['amount']);
            $bankItem->setInserted($bankArray['exported']);
            $this->entityManager->persist($bankItem);
        }
        $this->entityManager->flush();
    }
}
