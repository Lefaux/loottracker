<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\User;
use App\Repository\CharacterRepository;
use App\Repository\RankRepository;
use App\Service\LuaParser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuildController extends AbstractController
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RankRepository
     */
    private $rankRepository;

    public function __construct(
        CharacterRepository $characterRepository,
        RankRepository$rankRepository,
        EntityManagerInterface $entityManager)
    {
        $this->characterRepository = $characterRepository;
        $this->rankRepository = $rankRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/guild", name="guild")
     */
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user && $user->hasRole('ROLE_RAIDMANAGER')) {
            return $this->render('guild/index.html.twig');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/guild/upload", name="guild_upload")
     * @param Request $request
     * @return Response
     */
    public function uploadAction(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user && $user->hasRole('ROLE_RAIDMANAGER')) {
            $guildString = $request->request->get('guilddata');
            $parser = new LuaParser($guildString);
            $guildData = $parser->parse();
            if (array_key_exists('gbm_guildmembers', $guildData)) {
                foreach ($guildData['gbm_guildmembers'] as $memberRow) {
                    $member = explode(' | ', $memberRow);
                    $this->insertOrUpdateChar($member);
                }
            }
            $this->entityManager->flush();
        }
        $this->addFlash('success', 'Done uploading');
        return $this->redirectToRoute('guild');
    }

    private function insertOrUpdateChar(array $char): void
    {
        $charName = str_replace('-Razorfen', '', $char[0]);
        if ((int)$char[1] < 55) {
            return;
        }
        $character = $this->characterRepository->findOneBy(['name' => $charName]);
        if (!$character) {
            $character = new Character();
            $this->addFlash('success', 'Added '. $charName);
            $character->setName($charName);
        }
        $character->setTwink(false);
        if ($char[3] === 'Twink') {
            $character->setTwink(true);
        }
        $rank = $this->rankRepository->findOneBy(['name' => $char[3]]);
        if ($rank) {
            $character->setRank($rank);
        }
        $upperClass = strtoupper($char[2]);
        $character->setClass(constant("\App\Utility\WowClassUtility::CLASS_$upperClass"));
        if ($character->getNote() === null) {
            $character->setNote($char[4]);
        }
        $this->entityManager->persist($character);
    }
}
