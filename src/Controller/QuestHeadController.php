<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
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
                2 => true,
            ];
            $filters['class'] = [
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => true,
                7 => true,
                9 => true,
            ];
        }
        $byHead = $this->characterRepository->findByHead($filters);
        $foo = '';
        return $this->render('quest_head/index.html.twig', [
            'characters' => $byHead,
            'filters' => $filters
        ]);
    }
}
