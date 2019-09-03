<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaidRepository")
 */
class Raid
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Attendance", mappedBy="raid", cascade={"persist", "remove"})
     */
    private $attendance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAttendance(): ?Attendance
    {
        return $this->attendance;
    }

    public function setAttendance(Attendance $attendance): self
    {
        $this->attendance = $attendance;

        // set the owning side of the relation if necessary
        if ($this !== $attendance->getRaid()) {
            $attendance->setRaid($this);
        }

        return $this;
    }
}
