<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SignupRepository")
 */
class Signup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RaidEvent", inversedBy="signups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raidEvent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="signups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $team;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $signedUp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed;

    public function __toString()
    {
        return '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaidEvent(): ?RaidEvent
    {
        return $this->raidEvent;
    }

    public function setRaidEvent(?RaidEvent $raidEvent): self
    {
        $this->raidEvent = $raidEvent;

        return $this;
    }

    public function getPlayerName(): ?Character
    {
        return $this->playerName;
    }

    public function setPlayerName(?Character $playerName): self
    {
        $this->playerName = $playerName;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(?string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getSignedUp(): ?int
    {
        return $this->signedUp;
    }

    public function setSignedUp(?int $signedUp): self
    {
        $this->signedUp = $signedUp;

        return $this;
    }

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }
}
