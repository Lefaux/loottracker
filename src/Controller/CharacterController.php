<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\Character;
use App\Entity\Raid;
use App\Repository\CharacterRepository;
use App\Repository\LootRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var LootRepository
     */
    private $lootRepository;

    public function __construct(CharacterRepository $characterRepository, LootRepository $lootRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->lootRepository = $lootRepository;
    }

    /**
     * @Route("/character/{charId}", name="character")
     * @param int $charId
     * @return Response
     */
    public function index(int $charId): Response
    {
        $raids = [];
        $char = $this->characterRepository->find($charId);
        if (!$char) {
            return new Response('Char not found', 404);
        }
        foreach ($char->getAttendances() as $attendance) {
            $raids[] = $this->compileRaidData($attendance);
        }
        return $this->render('character/index.html.twig', [
            'character' => $char,
            'raids' => $raids
        ]);
    }

    private function findLootsPerRaidAndChar(Raid $raid, Character $character): array
    {
        $lootsPerRaid = $this->lootRepository->findBy([
            'raid' => $raid,
            'player' => $character
        ]);
        return $lootsPerRaid;
    }

    private function compileRaidData(Attendance $attendance): array
    {
        $output = [];
        if ($attendance->getRaidnight()) {
            $output = [
                'raid' => $attendance->getRaidnight(),
                'loots' => $this->findLootsPerRaidAndChar($attendance->getRaidnight(), $attendance->getPlayer())
            ];
        }
        return $output;
    }
}
