<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LootRepository")
 */
class Loot
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
    private $charname;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Raid", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $raid;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Item", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharname(): ?Character
    {
        return $this->charname;
    }

    public function setCharname(Character $charname): self
    {
        $this->charname = $charname;

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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(Item $item): self
    {
        $this->item = $item;

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
}
