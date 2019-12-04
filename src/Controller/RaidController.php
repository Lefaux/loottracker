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
     * @Route("/raid/setup/{raidGroupId}", name="raid_setup")
     * @param $raidGroupId
     * @return Response
     */
    public function showSetupAction($raidGroupId): Response
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
        $raidGroup = $this->raidGroupRepository->find($raidGroupId);
        if (!$raidGroup) {
            return new Response('error finding raidgroup', 500);
        }
        $hydratedSetup = [];
        $setupCount = [
            'total' => 0,
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
        foreach ($raidGroup->getSetup()['groups'] as $groupIndex => $group) {
            foreach ($group as $playerIndex => $playerId) {
                $character = $this->characterRepository->find($playerId);
                if (in_array((int)$playerId, $charsOnAccount, true)) {
                    $userCharsInSetup[] = $character;
                }
                $hydratedSetup['groups'][$groupIndex][$playerIndex] = $character;
                $setupCount['total']++;
                $setupCount['specs'][$character->getSpec()]++;
                $setupCount['classes'][$character->getClass()]++;
            }
        }
        $hydratedSetup['count'] = $setupCount;
        $hydratedSetup['raidName'] = $raidGroup->getSetup()['raidName'];
        $hydratedSetup['raidZone'] = $raidGroup->getSetup()['raidZone'];
        $hydratedSetup['status'] = (isset($raidGroup->getSetup()['status'])) ?: 0;
        $raidGroup->setSetup($hydratedSetup);
        return $this->render('raid/showSetup.html.twig', [
            'raidGroup' => $raidGroup,
            'userCharsInSetup' => $userCharsInSetup
        ]);
    }
}
