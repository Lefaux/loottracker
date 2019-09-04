<?php

namespace App\Controller;

use App\Repository\RaidRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaidController extends AbstractController
{
    /**
     * @var RaidRepository
     */
    private $raidRepository;

    public function __construct(RaidRepository $raidRepository)
    {
        $this->raidRepository = $raidRepository;
    }
    /**
     * @Route("/raid", name="raid")
     */
    public function indexAction(): Response
    {
        $raids = $this->raidRepository->findAll();
        return $this->render('raid/index.html.twig', [
            'raids' => $raids,
        ]);
    }

    /**
     * @Route("/raid/show/{raidId}", name="raid_show")
     */
    public function showAction($raidId): Response
    {
        $raid = $this->raidRepository->find((int) $raidId);
        return $this->render('raid/show.html.twig', [
            'raid' => $raid,
        ]);
    }
}
