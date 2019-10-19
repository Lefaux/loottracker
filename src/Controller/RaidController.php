<?php

namespace App\Controller;

use App\Repository\RaidEventRepository;
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
    /**
     * @var RaidEventRepository
     */
    private $eventRepository;

    public function __construct(RaidRepository $raidRepository, RaidEventRepository $raidEventRepository)
    {
        $this->raidRepository = $raidRepository;
        $this->eventRepository = $raidEventRepository;
    }
    /**
     * @Route("/raid", name="raid")
     */
    public function indexAction(): Response
    {
        $raids = $this->raidRepository->findBy([], ['date' => 'DESC']);
        return $this->render('raid/index.html.twig', [
            'raids' => $raids,
        ]);
    }

    /**
     * @Route("/raid/show/{raidId}", name="raid_show")
     * @param $raidId
     * @return Response
     */
    public function showAction($raidId): Response
    {
        $raid = $this->raidRepository->find((int) $raidId);
        return $this->render('raid/show.html.twig', [
            'raid' => $raid,
        ]);
    }

    /**
     * @Route("/raid/edit/{raidId}", name="raid_edit")
     * @param $raidId
     * @return Response
     */
    public function editAction($raidId): Response
    {
        $raid = $this->raidRepository->find((int) $raidId);
        return $this->render('page/lootresult.html.twig', [
            'raid' => $raid,
        ]);
    }

    /**
     * @Route("/raid/signup/{event?}", name="raid_singup")
     * @return Response
     */
    public function signUpAction($event): Response
    {
        $raids = $this->eventRepository->findBy([

        ]);
        $activeRaid = null;
        if ($event) {
            $activeRaid = $this->eventRepository->find($event);
        }
        return $this->render('raid/signup.html.twig', [
            'raids' => $raids,
            'activeRaid' => $activeRaid
        ]);
    }
}
