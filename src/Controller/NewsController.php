<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    private $perPage = 10;

    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @Route("/news/{category?}", name="news")
     * @param $category
     * @return Response
     */
    public function index($category): Response
    {
        $categoryConstraint = [];
        if ($category) {
            $categoryConstraint = [
                'category' => $category
            ];
        }
        $newsEntries = $this->newsRepository->findBy(
            $categoryConstraint,
            [
                'publishedOn' => 'DESC'
            ],
            $this->perPage
        );
        return $this->render('news/index.html.twig', [
            'news' => $newsEntries
        ]);
    }

    /**
     * @Route("/news/show/{newsId}", name="news_show")
     * @param int $newsId
     * @return Response
     */
    public function show(int $newsId): Response
    {
        $news = $this->newsRepository->find($newsId);
        return $this->render('news/show.html.twig', [
            'news' => $news
        ]);
    }
}
