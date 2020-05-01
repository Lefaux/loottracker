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
            $usedRanks = [];
            $rankMapping = [
                'Guildleader' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Guildleader']),
                    'twink' => false
                ],
                'Offizier' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Officer']),
                    'twink' => false
                ],
                'Offizierstwink' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Officer']),
                    'twink' => true
                ],
                'Core' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Core']),
                    'twink' => false
                ],
                'Raider' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Raider']),
                    'twink' => false
                ],
                'Raid-Twink' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Raider']),
                    'twink' => true
                ],
                'Family&Friends' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Family&Friends']),
                    'twink' => false
                ],
                'Twink' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Raider']),
                    'twink' => true
                ],
                'Trial' => [
                    'rank' => $this->rankRepository->findOneBy(['name' => 'Trial']),
                    'twink' => false
                ],
            ];
            $guildString = $request->request->get('guilddata');
            $parser = new LuaParser($guildString);
            $guildData = $parser->parse();
            if (array_key_exists('gbm_guildmembers', $guildData)) {
                foreach ($guildData['gbm_guildmembers'] as $memberRow) {
                    $member = explode(' | ', $memberRow);
                    $usedRanks[$member['3']] = 1;
                    $this->insertOrUpdateChar($member, $rankMapping);
                }
            }
            $this->entityManager->flush();
        }
        $this->addFlash('success', 'Done uploading');
        return $this->redirectToRoute('guild');
    }

    private function insertOrUpdateChar(array $char, array $rankMapping): void
    {
        $charName = str_replace('-Razorfen', '', $char[0]);
        if (!array_key_exists($char[3], $rankMapping)) {
            $this->addFlash('danger', 'Rank "' . $char[3]  . '" not found in mapping for "' .  $charName.'"');
            return;
        }
        $character = $this->characterRepository->findOneBy(['name' => $charName]);
        if ($character) {
            $character->setTwink(false);
            $rank = $rankMapping[$char[3]]['rank'];
            if (!$rank) {
                $this->addFlash('danger', 'Rank "' . $char[3]  . '" not found in database for "' .  $charName.'"');
                return;
            }
            $character->setRank($rank);
            $character->setTwink($rankMapping[$char[3]]['twink']);
            $upperClass = strtoupper($char[2]);
            $character->setClass(constant("\App\Utility\WowClassUtility::CLASS_$upperClass"));
            if ($character->getNote() === null) {
                $character->setNote($char[4]);
            }
            $this->entityManager->persist($character);
        }
    }
}
