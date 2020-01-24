<?php

namespace App\Service;

use App\Entity\RaidGroup;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
use DateTimeInterface;

class RaidGroupService
{
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;

    /**
     * @var RaidGroupRepository
     */
    private $raidGroupRepository;

    public function __construct(RaidEventRepository $raidEventRepository, RaidGroupRepository $raidGroupRepository)
    {
        $this->raidEventRepository = $raidEventRepository;
        $this->raidGroupRepository = $raidGroupRepository;
    }
    public function findPlayersInOtherRaidGroupsInThisIdAndZone(RaidGroup $baseRaidGroup): array
    {
        $playersAssignedToOtherRaidGroups = [];
        // find ID end
        if ($baseRaidGroup->getEvent()) {
            $dates = $this->findIdStartAndEnd($baseRaidGroup->getEvent()->getStart());
            // find events in timeFrame
            $events = $this->raidEventRepository->findEventsInGivenMonth($dates['start'], $dates['end']);
            // find raidGroups in events
            $raidGroupPerZone = [];
            foreach ($events as $event) {
                $raidGroups = $this->raidGroupRepository->findBy([
                    'event' => $event
                ]);
                foreach ($raidGroups as $raidGroup) {
                    if ($raidGroup->getZone() === $baseRaidGroup->getZone() && $raidGroup->getId() !== $baseRaidGroup->getId()) {
                        $raidGroupPerZone[] = $raidGroup;
                    }
                }
            }
            // check for same zone
            foreach ($raidGroupPerZone as $groupSetup) {
                foreach ($groupSetup->getSetup()['groups'] as $group) {
                    foreach ($group as $player) {
                        $playersAssignedToOtherRaidGroups[] = (int)$player;
                    }
                }
            }
        }
        return $playersAssignedToOtherRaidGroups;
    }

    private function findIdStartAndEnd(DateTimeInterface $start): array
    {
        // find last wednesday
        $idStart = clone $start;
        $idEnd = clone $start;
        $idStart->modify('last wednesday');
        $idEnd->modify('next wednesday');
        $idEnd->modify('-1 second');
        return [
            'start' => $idStart,
            'end' => $idEnd
        ];
    }
}