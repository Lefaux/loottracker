<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="characters")
 */
class Character
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $class;

    /**
     * @ORM\Column(type="integer")
     */
    private $spec;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="player", orphanRemoval=true)
     */
    private $attendances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loot", mappedBy="player")
     */
    private $loots;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterLootRequirement", mappedBy="playerCharacter", orphanRemoval=true)
     */
    private $lootRequirements;

    public function __construct()
    {
        $this->attendances = new ArrayCollection();
        $this->loots = new ArrayCollection();
        $this->lootRequirements = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClass(): ?int
    {
        return $this->class;
    }

    public function setClass(int $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getSpec(): ?int
    {
        return $this->spec;
    }

    public function setSpec(int $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAccount(): ?User
    {
        return $this->account;
    }

    public function setAccount(?User $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances[] = $attendance;
            $attendance->setPlayer($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getPlayer() === $this) {
                $attendance->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Loot[]
     */
    public function getLoots(): Collection
    {
        return $this->loots;
    }

    public function addLoot(Loot $loot): self
    {
        if (!$this->loots->contains($loot)) {
            $this->loots[] = $loot;
            $loot->setPlayer($this);
        }

        return $this;
    }

    public function removeLoot(Loot $loot): self
    {
        if ($this->loots->contains($loot)) {
            $this->loots->removeElement($loot);
            // set the owning side to null (unless already changed)
            if ($loot->getPlayer() === $this) {
                $loot->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacterLootRequirement[]
     */
    public function getLootRequirements(): Collection
    {
        return $this->lootRequirements;
    }

    public function addLootRequirement(CharacterLootRequirement $lootRequirement): self
    {
        if (!$this->lootRequirements->contains($lootRequirement)) {
            $this->lootRequirements[] = $lootRequirement;
            $lootRequirement->setPlayerCharacter($this);
        }

        return $this;
    }

    public function removeLootRequirement(CharacterLootRequirement $lootRequirement): self
    {
        if ($this->lootRequirements->contains($lootRequirement)) {
            $this->lootRequirements->removeElement($lootRequirement);
            // set the owning side to null (unless already changed)
            if ($lootRequirement->getPlayerCharacter() === $this) {
                $lootRequirement->setPlayerCharacter(null);
            }
        }

        return $this;
    }
}
