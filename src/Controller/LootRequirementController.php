<?php


namespace App\Controller;


use App\Entity\CharacterLootRequirement;
use App\Form\CharacterLootRequirementType;
use App\Repository\CharacterLootRequirementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lootrequirement", name="lootrequirement_")
 */
class LootRequirementController extends AbstractController
{
    /**
     * @var CharacterLootRequirementRepository
     */
    private $requirementRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(CharacterLootRequirementRepository $requirementRepository, EntityManagerInterface $entityManager)
    {
        $this->requirementRepository = $requirementRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $requirement = new CharacterLootRequirement();
        $form = $this->createForm(CharacterLootRequirementType::class, $requirement, ['user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($requirement);
            $this->entityManager->flush();

            $this->addFlash('success', 'Requirement saved.');
        }

        return $this->render('loot_requirement/form.html.twig', ['form' => $form->createView()]);
    }
}