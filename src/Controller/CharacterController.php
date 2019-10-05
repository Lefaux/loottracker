<?php

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\Character;
use App\Entity\CharacterLootRequirement;
use App\Entity\Raid;
use App\Form\CharacterLootRequirementType;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
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

    public function __construct(CharacterRepository $characterRepository, LootRepository $lootRepository, EntityManagerInterface $entityManager)
    {
        $this->characterRepository = $characterRepository;
        $this->lootRepository = $lootRepository;
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
        $character = $this->characterRepository->find($charId);
        $requirement = new CharacterLootRequirement();
        $form = $this->createForm(
            CharacterLootRequirementType::class,
            $requirement,
            [
                'user' => $this->getUser()
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($requirement);
            $this->entityManager->flush();

            $this->addFlash('success', 'Requirement saved.');
        }
        return $this->render('character/bis_list.html.twig', [
            'character' => $character,
            'slots' => $this->mapSlots($slots),
            'form' => $form->createView()
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
            return 'Please Select A slot';
        }
        $slotMapping = [
            '10' => 'Hands'
        ];
        return $slotMapping[$slots];
    }
}
