<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
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
    private $raidEventRepository;
    /**
     * @var RaidGroupRepository
     */
    private $raidGroupRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    public function __construct(
        RaidRepository $raidRepository,
        RaidEventRepository $raidEventRepository,
        RaidGroupRepository $raidGroupRepository,
        CharacterRepository $characterRepository
    ) {
        $this->raidRepository = $raidRepository;
        $this->raidEventRepository = $raidEventRepository;
        $this->raidGroupRepository = $raidGroupRepository;
        $this->characterRepository = $characterRepository;
    }
    /**
     * @Route("/", name="raid")
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
     * @Route("/raid/setup/{raidId}", name="raid_setup")
     * @param $raidId
     * @return Response
     */
    public function showSetupAction($raidId): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $charsOnAccount = [];
        /** @var Character $character */
        foreach ($user->getCharacters() as $character) {
            $charsOnAccount[] = $character->getId();
        }
        $raid = $this->raidEventRepository->find((int) $raidId);
        if (!$raid) {
            return new Response('No Raid found', 404);
        }
        $raidGroups = $this->raidGroupRepository->findBy(['event' => $raid->getId()]);
        $hydratedSetup = [];
        $setupCount = [
            'specs' => [
                1 => 0,
                2 => 0,
                3 => 0,
            ],
            'classes' => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
            ]
        ];
        $userCharsInSetup = [];
        foreach ($raidGroups as $setupIndex => $raidGroup) {
            foreach ($raidGroup->getSetup()['groups'] as $groupIndex => $group) {
                foreach ($group as $playerIndex => $playerId) {
                    $character = $this->characterRepository->find($playerId);
                    if (in_array((int)$playerId, $charsOnAccount, true)) {
                        $userCharsInSetup[] = $character;
                    }
                    $hydratedSetup['groups'][$groupIndex][$playerIndex] = $character;
                    $setupCount['specs'][$character->getSpec()]++;
                    $setupCount['classes'][$character->getClass()]++;
                }
            }
            $hydratedSetup['count'] = $setupCount;
            $raidGroup->setSetup($hydratedSetup);
        }
        return $this->render('raid/showSetup.html.twig', [
            'raid' => $raid,
            'setups' => $raidGroups,
            'userCharsInSetup' => $userCharsInSetup
        ]);
    }
}
