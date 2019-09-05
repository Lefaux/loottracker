<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LootController extends AbstractController
{
    /**
     * @Route("/loot", name="loot")
     */
    public function index()
    {
        return $this->render('loot/index.html.twig', [
            'controller_name' => 'LootController',
        ]);
    }
}
