<?php

namespace App\Listener;

use App\Entity\Character;
use App\Entity\CharacterLootRequirement;
use App\Entity\Item;
use App\Entity\Loot;
use App\Repository\CharacterLootRequirementRepository;
use Doctrine\ORM\EntityManagerInterface;

class LootListener
{
    /**
     * @var CharacterLootRequirementRepository
     */
    private $bisRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CharacterLootRequirementRepository $bisRepository, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->bisRepository = $bisRepository;
    }

    public function postUpdate(Loot $loot): void
    {
        $bisEntry = $this->checkIfInBiSList($loot->getPlayer(), $loot->getItem());
        if ($bisEntry) {
            $bisEntry->setHasItem(true);
            $this->em->persist($bisEntry);
            $this->em->flush();
        }
    }

    private function checkIfInBiSList(Character $character, Item $item): ?CharacterLootRequirement
    {
        return $this->bisRepository->findOneBy([
            'playerCharacter' => $character,
            'item' => $item
        ]);
    }
}