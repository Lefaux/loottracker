<?php

namespace App\Controller;

use App\Repository\CharacterLootRequirementRepository;
use App\Utility\WowClassUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestInSlotController extends AbstractController
{
    /**
     * @var CharacterLootRequirementRepository
     */
    private $bisRepository;

    public function __construct(CharacterLootRequirementRepository $characterLootRequirementRepository)
    {
        $this->bisRepository = $characterLootRequirementRepository;
    }

    /**
     * @Route("/bis", name="best_in_slot")
     */
    public function index(): Response
    {
        $bisList = $this->bisRepository->getBisList();
        return $this->render('best_in_slot/index.html.twig', [
            'bis' => $bisList,
            'classUtility' => new WowClassUtility()
        ]);
    }
}
