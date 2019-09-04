<?php

namespace App\Controller;

use App\Service\LuaParser;
use App\Service\RaidTrackerParsingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @var RaidTrackerParsingService
     */
    private $parser;

    public function __construct(RaidTrackerParsingService $raidTrackerParsingService)
    {
        $this->parser = $raidTrackerParsingService;
    }

    /**
     * @Route("/", name="page_index")
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('page/index.html.twig');
    }

    /**
     * @Route("/upload", name="page")
     */
    public function uploadAction()
    {
        $this->parser->parse('/var/www/html/var/CT_RaidTracker.lua');
        $foo = '';
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PageController.php',
        ]);
    }

    /**
     * @Route("/page/privacy", name="page_privacy")
     * @return Response
     */
    public function privacyAction(): Response
    {
        return $this->render('page/privacy.html.twig');
    }

    /**
     * @Route("/page/legal", name="page_legal")
     * @return Response
     */
    public function legalAction(): Response
    {
        return $this->render('page/legal.html.twig');
    }
}
