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
     * @ORM\OneToOne(targetEntity="App\Entity\Character", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $character_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Raid", inversedBy="attendance", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $raid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacterId(): ?Character
    {
        return $this->character_id;
    }

    public function setCharacterId(Character $character_id): self
    {
        $this->character_id = $character_id;

        return $this;
    }

    public function getRaid(): ?Raid
    {
        return $this->raid;
    }

    public function setRaid(Raid $raid): self
    {
        $this->raid = $raid;

        return $this;
    }
}
