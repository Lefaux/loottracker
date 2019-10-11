<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Repository\LootRepository;
use App\Service\RaidTrackerParsingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/", name="page_index")
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->renderTemplate('page/index.html.twig');
    }

    /**
     * @Route("/upload", name="page_upload")
     */
    public function uploadAction(): Response
    {
        return $this->renderTemplate('page/upload.html.twig');
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
        $xml = simplexml_load_string($dkpString);
        $xml_array = unserialize(
            serialize(
                json_decode(
                    json_encode(
                        (array) $xml), 1)
            ), [false]
        );
        $raidData = $this->parser->parseDkpString($xml_array);
        return $this->render('page/lootresult.html.twig', ['raid' => $raidData]);
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
     * @Route("/storedata")
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function storeData(Request $request): Response
    {
        $fileData = $request->files->getIterator()->current();
        if ($fileData) {
            return $this->parseAction($fileData[0]);
        }
        return new Response('no file given');
    }

    /**
     * @param UploadedFile $file
     * @return Response
     */
    public function parseAction(UploadedFile $file): Response
    {
        $filename = $this->params->get('kernel.project_dir') . '/var/' . date('Y-m-d_h:i:s') . '-' . uniqid('', false) . '.lua';
        if ($file->getClientOriginalName() !== 'CT_RaidTracker.lua') {
            return new JsonResponse(
                [
                    'files' => [
                        [
                            'name' => $file->getClientOriginalName(),
                            'size' => $file->getSize(),
                            'error' => 'This is not the bank LUA file'
                        ]
                    ]
                ],
                200
            );
        }
        // store file to disk
        copy($file->getPathname(), $filename);
        $this->parser->parse($filename);
        return new JsonResponse(
            [
                'files' => [
                    [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                    ]
                ]
            ],
            200
        );
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

    private function renderTemplate(string $name): Response
    {
        if ($this->loader->exists($this->params->get('layout') . '/' . $name)) {
            return $this->render($this->params->get('layout') . '/' . $name);
        }
        return $this->render($name);
    }
}
