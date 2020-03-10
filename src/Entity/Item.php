<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemLevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $requiredLevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $quality;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastImport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $class;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subClass;

    /**
     * @ORM\Column(type="integer")
     */
    private $classFromWH;

    /**
     * @ORM\Column(type="integer")
     */
    private $subClassFromWH;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loot", mappedBy="item")
     */
    private $loots;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_de;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $inventorySlot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hidden;

    public function __construct()
    {
        $this->loots = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getItemLevel(): ?int
    {
        return $this->itemLevel;
    }

    public function setItemLevel(int $itemLevel): self
    {
        $this->itemLevel = $itemLevel;

        return $this;
    }

    public function getRequiredLevel(): ?int
    {
        return $this->requiredLevel;
    }

    public function setRequiredLevel(int $requiredLevel): self
    {
        $this->requiredLevel = $requiredLevel;

        return $this;
    }

    public function getQuality(): ?int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function getLastImport(): ?DateTimeInterface
    {
        return $this->lastImport;
    }

    public function setLastImport(DateTimeInterface $lastImport): self
    {
        $this->lastImport = $lastImport;

        return $this;
    }

    public function getClass(): ?Category
    {
        return $this->class;
    }

    public function setClass(?Category $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getSubClass(): ?SubCategory
    {
        return $this->subClass;
    }

    public function setSubClass(?SubCategory $subClass): self
    {
        $this->subClass = $subClass;

        return $this;
    }

    public function getClassFromWH(): ?int
    {
        return $this->classFromWH;
    }

    public function setClassFromWH(int $classFromWH): self
    {
        $this->classFromWH = $classFromWH;

        return $this;
    }

    public function getSubClassFromWH(): ?int
    {
        return $this->subClassFromWH;
    }

    public function setSubClassFromWH(int $subClassFromWH): self
    {
        $this->subClassFromWH = $subClassFromWH;

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
            $loot->setItem($this);
        }

        return $this;
    }

    public function removeLoot(Loot $loot): self
    {
        if ($this->loots->contains($loot)) {
            $this->loots->removeElement($loot);
            // set the owning side to null (unless already changed)
            if ($loot->getItem() === $this) {
                $loot->setItem(null);
            }
        }

        return $this;
    }

    public function getNameDe(): ?string
    {
        return $this->name_de;
    }

    public function setNameDe(?string $name_de): self
    {
        $this->name_de = $name_de;

        return $this;
    }

    public function getInventorySlot(): ?int
    {
        return $this->inventorySlot;
    }

    public function setInventorySlot(?int $inventorySlot): self
    {
        $this->inventorySlot = $inventorySlot;

        return $this;
    }

    public function getZone(): ?int
    {
        return $this->zone;
    }

    public function setZone(?int $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getAbbreviation()
    {
        $shortName = [];
        $parts = explode(' ', $this->name);
        foreach ($parts as $part) {
            $shortName[] = substr($part, 0, 1);
        }
        return implode('', $shortName);
    }

    public function getHidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): self
    {
        $this->hidden = $hidden;

        return $this;
    }
}
