<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\Character;
use App\Entity\CharacterLootRequirement;
use App\Entity\Raid;
use App\Form\BisItemType;
use App\Form\CharacterLootRequirementType;
use App\Form\CharacterType;
use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\LootRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var LootRepository
     */
    private $lootRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CharacterLootRequirementRepository
     */
    private $lootRequirementRepository;
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(
        CharacterRepository $characterRepository,
        LootRepository $lootRepository,
        CharacterLootRequirementRepository $lootRequirementRepository,
        ItemRepository $itemRepository,
        EntityManagerInterface $entityManager)
    {
        $this->characterRepository = $characterRepository;
        $this->lootRepository = $lootRepository;
        $this->lootRequirementRepository = $lootRequirementRepository;
        $this->itemRepository = $itemRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/roster", name="roster")
     * @return Response
     */
    public function indexAction(): Response
    {
        $roster = [];
        $fullRoster = $this->characterRepository->findAll();
        foreach ($fullRoster as $item) {
            $roster[$item->getClass()][] = $item;
        }
        return $this->render('character/index.html.twig', ['roster' => $roster]);
    }

    /**
     * @Route("/character/{charId}", name="character")
     * @param int $charId
     * @return Response
     */
    public function characterDetailsAction(int $charId): Response
    {
        $raids = [];
        $char = $this->characterRepository->find($charId);
        if (!$char) {
            return new Response('Char not found', 404);
        }
        foreach ($char->getAttendances() as $attendance) {
            $raids[] = $this->compileRaidData($attendance);
        }
        return $this->render('character/detail.html.twig', [
            'character' => $char,
            'raids' => $raids
        ]);
    }

    /**
     * @Route("/profile/characters", name="profile_character")
     * @return Response
     */
    public function myCharactersAction(): Response
    {
        $characters = $this->characterRepository->findBy(['account' => $this->getUser()]);

        return $this->render('user/my_characters.html.twig', ['characters' => $characters]);
    }

    /**
     * @Route("/characters/create", name="character_create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exists = $this->characterRepository->findOneBy(['name' => $character->getName()]);
            if (null === $exists) {
                $character->setAccount($this->getUser());
                $this->entityManager->persist($character);
                $this->entityManager->flush();

                $this->addFlash('success', 'Character saved.');

                return $this->redirectToRoute('profile_character');
            }

            $this->addFlash('danger', 'That character name is already taken.');
        }

        return $this->render('loot_requirement/form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/character/{charId}/update", name="character_update")
     * @param int $charId
     * @param Request $request
     * @return Response
     */
    public function updateAction(int $charId, Request $request): Response
    {
        $character = $this->characterRepository
        ->findOneBy(['account' => $this->getUser(), 'id' => $charId]);

        if (null === $character) {
            return $this->redirectToRoute('character_create');
        }

        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exists = $this->characterRepository->findOneBy(['name' => $character->getName()]);
            if (null === $exists || $exists->getId() === $character->getId()) {
                $character->setAccount($this->getUser());
                $this->entityManager->persist($character);
                $this->entityManager->flush();

                $this->addFlash('success', 'Character saved.');

                return $this->redirectToRoute('profile_character');
            }

            $this->addFlash('danger', 'That character name is already taken.');
        }

        return $this->render('loot_requirement/form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/character/{charId}/bislist/{slots?}", name="character_bislist")
     *
     * @param Request $request
     * @param int $charId
     * @param string $slots
     * @return Response
     */
    public function bisListViewAction(Request $request, int $charId, $slots): Response
    {
        $slot = $slots;
        $character = $this->characterRepository->find($charId);
        $items = $this->lootRequirementRepository->findBy([
            'playerCharacter' => $character,
            'slot' => $slot
        ]);
        $bisItems = [
            1 => null,
            2 => null,
            3 => null,
        ];
        foreach ($items as $item) {
            $bisItems[$item->getPriority()] = $item;
        }
        return $this->render('character/bis_list.html.twig', [
            'character' => $character,
            'slots' => $this->mapSlots($slots),
            'bisItems' => $bisItems,
            'slotIds' => $slots
        ]);
    }

    private function findLootsPerRaidAndChar(Raid $raid, Character $character): array
    {
        $lootsPerRaid = $this->lootRepository->findBy([
            'raid' => $raid,
            'player' => $character
        ]);
        return $lootsPerRaid;
    }

    /**
     * @Route("/save-bis/{charId}/{slot}", name="save_bis")
     * @param Request $request
     * @param int $charId
     * @param int $slot
     * @return Response
     */
    public function saveBisAction(Request $request, int $charId, int $slot): Response
    {
        $bisItem = $request->request->get('bisItem');
        $this->processBisItem($bisItem[1], 1, $charId, $slot);
        $this->processBisItem($bisItem[2], 2, $charId, $slot);
        $this->processBisItem($bisItem[3], 3, $charId, $slot);
        return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slots' => $slot]);
    }

    /**
     * @Route("/delete-bis/{charId}/{slot}", name="delete_bis")
     * @param Request $request
     * @param int $charId
     * @param int $slot
     * @return Response
     */
    public function deleteBis(Request $request, int $charId, int $slot): Response
    {
        $this->addFlash('success', 'BiS Item removed');
        $bis = $request->get('bis');
        $character = $this->characterRepository->find($charId);
        if ($character === null) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slots' => $slot]);
        }
        if ($character->getAccount() !== $this->getUser()) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slots' => $slot]);
        }
        $bisEntry = $this->lootRequirementRepository->find((int)$bis);
        if ($bisEntry === null) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slots' => $slot]);
        }
        if ($bisEntry->getPlayerCharacter() === $character && $bisEntry->getPlayerCharacter()->getAccount() === $this->getUser()) {
            $this->entityManager->remove($bisEntry);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slots' => $slot]);
    }

    private function compileRaidData(Attendance $attendance): array
    {
        $output = [];
        if ($attendance->getRaidnight()) {
            $output = [
                'raid' => $attendance->getRaidnight(),
                'loots' => $this->findLootsPerRaidAndChar($attendance->getRaidnight(), $attendance->getPlayer())
            ];
        }
        return $output;
    }

    private function mapSlots($slots): string
    {
        if (!$slots) {
            return '';
        }
        $slotMapping = [
            1 => 'Head',
            2 => 'Neck',
            3 => 'Shoulder',
            5 => 'Chest',
            6 => 'Belt',
            7 => 'Legs',
            9 => 'Wrist',
            10 => 'Hands',
            11 => 'Ring',
            12 => 'Trinket',
            13 => 'Main Hand',
            14 => 'Off Hand',
            15 => 'Ranged',
            16 => 'Back',
        ];
        return $slotMapping[$slots];
    }

    private function processBisItem(array $item, int $priority, int $charId, int $slot): void
    {
        $character = $this->characterRepository->find($charId);
        if ($character === null) {
            throw new \RuntimeException('No character found for id');
        }
        foreach ($item as $index => $processInfo) {
            if (is_int($index)) {
                $lootEntry = $this->lootRequirementRepository->findBy([
                    'playerCharacter' => $character,
                    'slot' => $slot,
                    'item' => $index
                ]);
                if (count($lootEntry) > 1) {
                    throw new \RuntimeException('Duplicate Item per slot');
                }
                if (count($lootEntry) === 0) {
                    throw new \RuntimeException('Hacking attempt');
                }
                if ($lootEntry[0]->hasItem() === true && $processInfo['hasItem'] === '0') {
                    $lootEntry[0]->setHasItem(false);
                    $this->entityManager->persist($lootEntry[0]);
                }
                if ($lootEntry[0]->hasItem() === false && $processInfo['hasItem'] === 'on') {
                    $lootEntry[0]->setHasItem(true);
                    $this->entityManager->persist($lootEntry[0]);
                }

            } elseif ($index === 'itemId' && (int)$processInfo > 0) {
                // todo insert
                $itemFromDb = $this->itemRepository->find((int)$processInfo);
                if ($character->getAccount() !== $this->getUser()) {
                    throw new \RuntimeException('Hacking attempt... trying to add item to foreign character');
                }
                if ($item) {
                    $bisEntry = new CharacterLootRequirement();
                    $bisEntry->setSlot($slot);
                    $bisEntry->setPlayerCharacter($character);
                    $bisEntry->setItem($itemFromDb);
                    $bisEntry->setHasItem(false);
                    $bisEntry->setPriority($priority);
                    $this->entityManager->persist($bisEntry);
                }
            }
        }
        $this->entityManager->flush();
    }
}
