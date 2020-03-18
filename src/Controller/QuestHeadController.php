<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use App\Utility\WowRaceUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestHeadController extends AbstractController
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/quest/head", name="quest_head")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $filters = $request->get('f');
        if (!is_array($filters)) {
            $filters['head'] = [
                1 => true,
                2 => true
            ];
            $filters['mode'] = [
                1 => true,
            ];
        }
        return $this->render('quest_head/index.html.twig', [
            'characters' => $this->characterRepository->findByHead($filters),
            'filters' => $filters
        ]);
    }
}
