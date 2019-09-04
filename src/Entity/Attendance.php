<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Raid", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $raidnight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Character
    {
        return $this->player;
    }

    public function setPlayer(?Character $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getRaidnight(): ?Raid
    {
        return $this->raidnight;
    }

    public function setRaidnight(?Raid $raidnight): self
    {
        $this->raidnight = $raidnight;

        return $this;
    }
}
