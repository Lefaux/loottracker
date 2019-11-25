<?php


namespace App\Controller\Api;


use App\Entity\RaidGroup;
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
        $raidSetup = json_decode($request->getContent(), true);
        unset($raidSetup['groups'][0]);
        $raidEvent = $raidEventRepository->find($raidSetup['raidEvent']);
        $raidGroup = $raidGroupRepository->findOneBy(['event' => $raidSetup['raidEvent']]);
        if (!$raidGroup) {
            $raidGroup = new RaidGroup();
        }
        // @todo add these
        $raidGroup->setZone('kommt noch');
        $raidGroup->setName('kommt noch');
        $raidGroup->setComment('kommt noch');
        $raidGroup->setStart(new \DateTime());

        $raidGroup->setEvent($raidEvent);
        $raidGroup->setSetup($raidSetup);
        $entityManager->persist($raidGroup);
        $entityManager->flush();
        return $this->json(['status' => 'saved']);
    }
}