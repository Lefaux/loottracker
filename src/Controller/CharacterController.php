<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\Character;
use App\Entity\CharacterLootRequirement;
use App\Entity\Raid;
use App\Entity\Recipe;
use App\Form\CharacterType;
use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\LootRepository;
use App\Repository\RecipeRepository;
use App\Utility\WowClassUtility;
use App\Utility\WowProfessionUtility;
use App\Utility\WowRaceUtility;
use App\Utility\WowSlotUtility;
use App\Utility\WowSpecUtility;
use App\Utility\WoWZoneUtility;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    /**
     * @var RecipeRepository
     */
    private $recipeRepository;

    public function __construct(
        CharacterRepository $characterRepository,
        LootRepository $lootRepository,
        CharacterLootRequirementRepository $lootRequirementRepository,
        ItemRepository $itemRepository,
        RecipeRepository $recipeRepository,
        EntityManagerInterface $entityManager)
    {
        $this->characterRepository = $characterRepository;
        $this->lootRepository = $lootRepository;
        $this->lootRequirementRepository = $lootRequirementRepository;
        $this->itemRepository = $itemRepository;
        $this->recipeRepository = $recipeRepository;
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
     * @Route("/roster/recipes/{subClass?}", name="roster_recipe")
     * @param $subClass
     * @return Response
     */
    public function recipeAction($subClass): Response
    {
        $recipes = false;
        $categories = $this->recipeRepository->findRecipeCategories();
        if ($subClass) {
            $recipes = $this->recipeRepository->findByCategory($subClass);
        }
        return $this->render('character/recipes.html.twig', [
            'categories' => $categories,
            'subClass' => $subClass,
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/character/{charId}", name="character")
     * @param int $charId
     * @param WowProfessionUtility $wowProfessionUtility
     * @param WoWZoneUtility $woWZoneUtility
     * @return Response
     */
    public function characterDetailsAction(int $charId, WowProfessionUtility $wowProfessionUtility, WoWZoneUtility $woWZoneUtility): Response
    {
        $raids = [];
        $char = $this->characterRepository->find($charId);
        if (!$char) {
            return new Response('Char not found', 404);
        }
        foreach ($char->getAttendances() as $attendance) {
            $raids[] = $this->compileRaidData($attendance);
        }
        $needsItemsFromZones = $this->lootRequirementRepository->findItemsByCharId($charId);
        return $this->render('character/detail.html.twig', [
            'character' => $char,
            'raids' => $raids,
            'professions' => $wowProfessionUtility,
            'zones' => $woWZoneUtility,
            'itemsByZone' => $needsItemsFromZones
        ]);
    }

    /**
     * @Route("/profile/characters", name="profile_character")
     * @param WowClassUtility $wowClassUtility
     * @param WowSpecUtility $wowSpecUtility
     * @param WowRaceUtility $wowRaceUtility
     * @return Response
     */
    public function myCharactersAction(WowClassUtility $wowClassUtility, WowSpecUtility $wowSpecUtility, WowRaceUtility $wowRaceUtility): Response
    {
        $characters = $this->characterRepository->findBy(['account' => $this->getUser()]);

        return $this->render('user/my_characters.html.twig', [
            'characters' => $characters,
            'raceUtility' => $wowRaceUtility,
            'specUtility' => $wowSpecUtility,
            'classUtility' => $wowClassUtility
        ]);
    }

    /**
     * @Route("/characters/create", name="character_create")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
     */
    public function createAction(Request $request, TranslatorInterface $translator): Response
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

                $this->addFlash('success', $translator->trans('Character saved.'));

                return $this->redirectToRoute('profile_character');
            }

            $this->addFlash('danger', $translator->trans('That character name is already taken.'));
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

        /**
         * Add recipes
         */
        $recipe = $request->get('recipe');
        if (isset($recipe['itemId'])) {
            $recipeItem = $this->itemRepository->find((int)$recipe['itemId']);
            if ($recipeItem !== null) {
                $checkIfEntryExists = $this->recipeRepository->findBy(
                    [
                        'Player' => $character->getId(),
                        'recipe' => $recipeItem
                    ]
                );
                if (count($checkIfEntryExists) === 0) {
                    $entry = new Recipe();
                    $entry->setPlayer($character);
                    $entry->setRecipe($recipeItem);
                    $character->addRecipe($entry);
                    $this->entityManager->persist($entry);
                    $this->entityManager->persist($character);
                    $this->entityManager->flush();
                    $this->addFlash('success', 'Added recipe ' . $recipeItem->getName());
                return $this->redirectToRoute('character_update', ['charId' => $character->getId()]);
                }
            }
        }

        /**
         * Remove Recipes
         */
        $removeRecipeId = $request->get('removeRecipeId');
        if ($removeRecipeId !== null) {
            $recipeItem = $this->recipeRepository->find((int)$removeRecipeId);
            if ($recipeItem !== null) {
                $this->entityManager->remove($recipeItem);
                $this->entityManager->flush();
                $this->addFlash('success', 'Removed recipe ' . $recipeItem->getRecipe()->getName());
            }
        }
        return $this->render(
            'loot_requirement/form.html.twig',
            [
                'form' => $form->createView(),
                'character' => $character
            ]
        );
    }

    /**
     * @Route("/character/{charId}/bislist/{slotId?}", name="character_bislist")
     *
      * @param int $charId
     * @param int $slotId
     * @param WowSlotUtility $wowSlotUtility
     * @return Response
     */
    public function bisListViewAction(int $charId, $slotId, WowSlotUtility $wowSlotUtility): Response
    {
        $character = $this->characterRepository->find($charId);
        $items = $this->lootRequirementRepository->findBy([
            'playerCharacter' => $character,
        ]);
        $bisItems = [];
        foreach ($wowSlotUtility::toArray() as $slotIdFromUtility => $_) {
            $bisItems[$slotIdFromUtility] = [
                1 => null,
                2 => null,
                21 => null,
                22 => null,
                31 => null,
                32 => null,
                41 => null,
                42 => null,
                51 => null,
                52 => null,
            ];
        }
        /**
         * Add rings and trinkets
         */
        $bisItems[11][3] = null;
        $bisItems[11][4] = null;
        $bisItems[11][23] = null;
        $bisItems[11][24] = null;
        $bisItems[11][33] = null;
        $bisItems[11][34] = null;
        $bisItems[11][43] = null;
        $bisItems[11][44] = null;
        $bisItems[11][53] = null;
        $bisItems[11][54] = null;
        $bisItems[12][3] = null;
        $bisItems[12][4] = null;
        $bisItems[12][23] = null;
        $bisItems[12][24] = null;
        $bisItems[12][33] = null;
        $bisItems[12][34] = null;
        $bisItems[12][43] = null;
        $bisItems[12][44] = null;
        $bisItems[12][53] = null;
        $bisItems[12][54] = null;
        foreach ($items as $item) {
            $bisItems[$item->getSlot()][$item->getPriority()] = $item;
        }
        return $this->render('character/bis_list.html.twig', [
            'character' => $character,
            'bisItems' => $bisItems,
            'slotId' => $slotId,
            'slotUtility' => $wowSlotUtility
        ]);
    }

    private function findLootsPerRaidAndChar(Raid $raid, Character $character): array
    {
        return $this->lootRepository->findBy([
            'raid' => $raid,
            'player' => $character
        ]);
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
        foreach ($bisItem as $index => $item) {
            $this->processBisItem($item, $index, $charId, $slot);
        }
        return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slotId' => $slot]);
    }

    /**
     * @Route("/delete-bis/{charId}/{slot}", name="delete_bis")
     * @param Request $request
     * @param int $charId
     * @param int $slot
     * @return Response
     * @throws Exception
     */
    public function deleteBis(Request $request, int $charId, int $slot): Response
    {
        $this->addFlash('success', 'BiS Item removed');
        $bis = $request->get('bis');
        $character = $this->characterRepository->find($charId);
        if ($character === null) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slotId' => $slot]);
        }
        if ($character->getAccount() !== $this->getUser()) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slotId' => $slot]);
        }
        $bisEntry = $this->lootRequirementRepository->find((int)$bis);
        if ($bisEntry === null) {
            return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slotId' => $slot]);
        }
        if ($bisEntry->getPlayerCharacter() === $character && $bisEntry->getPlayerCharacter()->getAccount() === $this->getUser()) {
            $this->entityManager->remove($bisEntry);
            $this->entityManager->flush();
            $character->setLastUpdate(new DateTime());
            $this->entityManager->persist($character);
        }
        return $this->redirectToRoute('character_bislist', ['charId' => $charId, 'slotId' => $slot]);
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

    private function processBisItem(array $item, int $priority, int $charId, int $slot): void
    {
        $character = $this->characterRepository->find($charId);
        if ($character === null) {
            throw new RuntimeException('No character found for id');
        }
        foreach ($item as $index => $processInfo) {
            if (is_int($index)) {
                $lootEntry = $this->lootRequirementRepository->findBy([
                    'playerCharacter' => $character,
                    'slot' => $slot,
                    'item' => $index
                ]);
                if (count($lootEntry) > 1) {
                    $this->addFlash('error', 'Duplicate Item per slot');
//                    throw new \RuntimeException('Duplicate Item per slot');
                }
                if (count($lootEntry) === 0) {
                    throw new RuntimeException('Hacking attempt');
                }
                if ($lootEntry[0]->hasItem() === true && $processInfo['hasItem'] === '0') {
                    $lootEntry[0]->setHasItem(false);
                    $this->entityManager->persist($lootEntry[0]);
                }
                if ($lootEntry[0]->hasItem() === false && $processInfo['hasItem'] === 'on') {
                    $lootEntry[0]->setHasItem(true);
                    $this->entityManager->persist($lootEntry[0]);
                    $character->setLastUpdate(new DateTime());
                    $this->entityManager->persist($character);
                }

            } elseif ($index === 'itemId' && (int)$processInfo > 0) {
                // todo insert
                $itemFromDb = $this->itemRepository->find((int)$processInfo);
                if ($character->getAccount() !== $this->getUser()) {
                    throw new RuntimeException('Hacking attempt... trying to add item to foreign character');
                }
                if ($item) {
                    $bisEntry = new CharacterLootRequirement();
                    $bisEntry->setSlot($slot);
                    $bisEntry->setPlayerCharacter($character);
                    $bisEntry->setItem($itemFromDb);
                    $bisEntry->setHasItem(false);
                    $bisEntry->setPriority($priority);
                    $this->entityManager->persist($bisEntry);
                    $character->setLastUpdate(new DateTime());
                    $this->entityManager->persist($character);
                }
            }
        }
        $this->entityManager->flush();
    }
}
