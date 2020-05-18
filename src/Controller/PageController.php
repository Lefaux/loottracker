<?php

namespace App\Controller;

use App\Entity\Raid;
use App\Repository\CharacterRepository;
use App\Repository\LootRepository;
use App\Repository\RecruitmentEntryRepository;
use App\Service\RaidTrackerParsingService;
use App\Utility\WowClassUtility;
use App\Utility\WowSpecUtility;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class PageController extends AbstractController
{
    /**
     * @var RaidTrackerParsingService
     */
    private $parser;
    /**
     * @var ParameterBagInterface
     */
    private $params;
    /**
     * @var LoaderInterface
     */
    private $loader;
    /**
     * @var LootRepository
     */
    private $lootRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        RaidTrackerParsingService $raidTrackerParsingService,
        ParameterBagInterface $params,
        Environment $twig,
        LootRepository $lootRepository,
        CharacterRepository $characterRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->parser = $raidTrackerParsingService;
        $this->params = $params;
        $this->loader = $twig->getLoader();
        $this->lootRepository = $lootRepository;
        $this->characterRepository = $characterRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/upload/dkpstring", name="page_upload_dkp")
     */
    public function dkpStringAction(): Response
    {
        return $this->render('page/uploaddkpstring.html.twig');
    }

    /**
     * @Route("upload/raidresult", name="page_parse_dkp")
     * @param Request $request
     * @return Response
     */
    public function parseDkpString(Request $request): Response
    {
        $dkpString = $request->request->get('dkpstring');
        $json = json_decode($dkpString, true);
        if (!$json) {
            $this->addFlash('danger', 'RC Council string was no valid JSON. Make sure you copied ALL text');
        }
        try {
            $raidData = $this->parser->parseDkpString($json);
            /** @var Raid $raid */
            foreach ($raidData as $raid) {
                $this->addFlash('success', 'Raid in ' . $raid->getZone() . ' on ' . $raid->getDate()->format('d.m.Y H:i:s') . ' imported');
            }
        } catch (Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }
        return $this->redirectToRoute('raid');
    }

    /**
     * @Route("upload/saveraidresult", name="page_save_dkp")
     * @param Request $request
     * @return Response
     */
    public function saveRaidResult(Request $request): Response
    {
        $loots = $request->request->get('loot');
        foreach ($loots as $lootId => $lootEntry) {
            $lootKey = array_key_first($lootEntry);
            if ($lootKey !== (int)$lootEntry[$lootKey]) {
                $lootObject = $this->lootRepository->find($lootId);
                if ($lootObject) {
                    $playerObject = $this->characterRepository->find((int)$lootEntry[$lootKey]);
                    $lootObject->setPlayer($playerObject);
                    $this->entityManager->persist($lootObject);
                    $this->entityManager->flush();
                }
            }
        }
        return $this->redirectToRoute('raid');
    }

    /**
     * @Route("/calendar", name="page_calendar")
     * @return Response
     */
    public function calendarAction(): Response
    {
        return $this->renderTemplate('page/calendar.html.twig');
    }

    /**
     * @Route("/page/privacy", name="page_privacy")
     * @return Response
     */
    public function privacyAction(): Response
    {
        return $this->renderTemplate('page/privacy.html.twig');
    }

    /**
     * @Route("/page/legal", name="page_legal")
     * @return Response
     */
    public function legalAction(): Response
    {
        return $this->renderTemplate('page/legal.html.twig');
    }

    /**
     * @Route("/", name="index")
     * @param WowSpecUtility $wowSpecUtility
     * @param WowClassUtility $wowClassUtility
     * @param RecruitmentEntryRepository $recruitmentEntryRepository
     * @return Response
     */
    public function indexAction(WowSpecUtility $wowSpecUtility, WowClassUtility $wowClassUtility, RecruitmentEntryRepository $recruitmentEntryRepository): Response
    {
        return $this->render('page/index.html.twig', [
            'recruitment' => $recruitmentEntryRepository->findBy([], ['demand' => 'ASC']),
            'progress' => $this->params->get('progress'),
            'specs' => $wowSpecUtility,
            'classes' => $wowClassUtility
        ]);
    }

    /**
     * @Route("/streams/recruitment", name="streams_recruitment")
     * @param WowSpecUtility $wowSpecUtility
     * @param WowClassUtility $wowClassUtility
     * @param RecruitmentEntryRepository $recruitmentEntryRepository
     * @return Response
     */
    public function recruitmentAction(WowSpecUtility $wowSpecUtility, WowClassUtility $wowClassUtility, RecruitmentEntryRepository $recruitmentEntryRepository): Response
    {
        return $this->render('streams/recruitment.html.twig', [
            'recruitment' => $recruitmentEntryRepository->findBy([], ['demand' => 'ASC']),
            'specs' => $wowSpecUtility,
            'classes' => $wowClassUtility
        ]);
    }

    private function renderTemplate(string $name, array $params = []): Response
    {
        if ($this->loader->exists($this->params->get('layout') . '/' . $name)) {
            return $this->render($this->params->get('layout') . '/' . $name, $params);
        }
        return $this->render($name, $params);
    }
}
