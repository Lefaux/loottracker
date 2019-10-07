<?php

namespace App\Controller;

use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Utility\WowClassUtility;
use App\Utility\WowRaceUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestInSlotController extends AbstractController
{
    /**
     * @var CharacterLootRequirementRepository
     */
    private $bisRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    public function __construct(
        CharacterLootRequirementRepository $characterLootRequirementRepository,
        CharacterRepository $characterRepository
    )
    {
//        $this->bisRepository = $characterLootRequirementRepository;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/bis", name="best_in_slot")
     */
    public function index(): Response
    {
//        $bisList = $this->bisRepository->getBisList();
        $bisListAndPlayers = [];
        $chars = $this->characterRepository->findAll();
        foreach ($chars as $char) {
            $bisItems = $char->getLootRequirements();
            $bisList = [
                1 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                2 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                3 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                5 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                6 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                7 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                8 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                9 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                10 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                11 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                12 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                13 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                14 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                15 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                16 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
            ];
            foreach ($bisItems as $bisItem) {
                $bisList[$bisItem->getSlot()][$bisItem->getPriority()] = $bisItem;
            }
            $bisListAndPlayers[$char->getClass()][] = [
                'char' => $char,
                'bisList' => $bisList
            ];
        }
        $foo = '';
        return $this->render('best_in_slot/index.html.twig', [
            'bis' => $bisListAndPlayers,
            'classUtility' => new WowClassUtility(),
            'raceUtility' => new WowRaceUtility()
        ]);
    }
}
