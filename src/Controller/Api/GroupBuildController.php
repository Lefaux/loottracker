<?php


namespace App\Controller\Api;


use App\Entity\RaidGroup;
use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/groupbuild", name="api_groupbuild_")
 */
class GroupBuildController extends AbstractController
{
    /**
     * @Route("/get", name="get")
     * @param Request $request
     * @param ItemRepository $itemRepository
     * @return Response
     */
    public function getAction(Request $request, ItemRepository $itemRepository): Response
    {


        return $this->json(['suggestions' => 'jaja']);
    }

    /**
     * @Route("/save", name="save")
     * @param Request $request
     * @param RaidGroupRepository $raidGroupRepository
     * @param RaidEventRepository $raidEventRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Exception
     */
    public function saveAction(
        Request $request,
        RaidGroupRepository $raidGroupRepository,
        RaidEventRepository $raidEventRepository,
        EntityManagerInterface $entityManager): Response
    {
        $payload = json_decode($request->getContent(), true);
        unset($payload['groups'][0]);
        $raidEvent = $raidEventRepository->find($payload['raidEvent']);
        if ($payload['raidGroup'] === 'new') {
            $raidGroup = new RaidGroup();
        } else {
            $raidGroup = $raidGroupRepository->find($payload['raidGroup']);
        }
        if (!$raidGroup || !$raidEvent) {
            return $this->json(['error' => 'true'], 500);
        }
        // @todo add these
        $raidGroup->setComment('kommt noch');

        $raidGroup->setZone((int)$payload['raidZone']);
        $raidGroup->setName($payload['raidName']);
        $raidGroup->setStart(new \DateTime());

        $raidGroup->setEvent($raidEvent);
        $raidGroup->setSetup($payload);
        if ($payload['raidGroup'] === 'new') {
            $raidEvent->addRaidGroup($raidGroup);
        }
        $entityManager->persist($raidGroup);
        $entityManager->flush();
        return $this->json([
            'status' => 'saved',
            'raidGroupId' => $raidGroup->getId()
        ]);
    }

    /**
     * @Route("/bisitems", name="bisitems")
     * @param Request $request
     * @param CharacterLootRequirementRepository $bisRepository
     * @param CharacterRepository $characterRepository
     * @return Response
     */
    public function bisItemsAction(
        Request $request,
        CharacterLootRequirementRepository $bisRepository,
        CharacterRepository $characterRepository): Response
    {
        $bisItems = [];
        $payload = json_decode($request->getContent(), true);
        $items = $bisRepository->findItemsByRaidGroup($payload['players'], $payload['raidZone']);
        foreach ($items as $item) {
            switch ($item['rank_id']) {
                case 2:
                case 7:
                case 3:
                    $rank = 'Core';
                    break;
                case 4:
                    $rank = 'Raider';
                    break;
                case 5:
                    $rank = 'Oldies';
                    break;
                case 6:
                    $rank = 'F&F';
                    break;
                default:
                    $rank = 'Core';
            }
            if ((int)$item['twink'] === 1) {
                $rank = 'Twink';
            }
            $bisItems[$item['id']]['item']['id'] = $item['id'];
            $bisItems[$item['id']]['item']['name'] = $item['name'];
            $playerIdArray = explode(',', $item['characterIds']);
            foreach ($playerIdArray as $charId) {
                $character = $characterRepository->find($charId);
                if ($character) {
                    $bisItems[$item['id']]['need'][$rank][] = [
                        'id' => $character->getId(),
                        'class' => $character->getClass(),
                        'name' => $character->getName()
                    ];
                }
            }
        }
        return $this->json($bisItems);
    }
}