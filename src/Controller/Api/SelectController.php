<?php


namespace App\Controller\Api;


use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/select", name="api_select_")
 */
class SelectController extends AbstractController
{
    /**
     * @Route("/items", name="items")
     * @param Request $request
     * @param ItemRepository $itemRepository
     * @return Response
     */
    public function items(Request $request, ItemRepository $itemRepository): Response
    {
        $items = $itemRepository->searchByName($request->get('search'), $request->get('slots'));
        $return = [];
        foreach ($items as $item) {
            $zone = $item->getZone();
            if ($zone === null) {
                $zone = 'unclear';
            } else {
                $zone = $zone->getName();
            }
            $return[] = [
                'id' => $item->getId(),
                'text' => $item->getName(),
                'icon' => $item->getIcon(),
                'quality' => $item->getQuality(),
                'ilvl' => $item->getItemLevel(),
                'zone' => $zone
            ];
        }

        return $this->json(['results' => $return]);
    }
}