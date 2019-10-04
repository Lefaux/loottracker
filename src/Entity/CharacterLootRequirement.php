<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterLootRequirementRepository")
 */
class CharacterLootRequirement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item")
     * @ORM\JoinColumn(nullable=false)
     * @var Item
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="lootRequirements")
     * @ORM\JoinColumn(nullable=false)
     * @var Character
     */
    private $playerCharacter;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $priority;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $hasItem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getPlayerCharacter(): ?Character
    {
        return $this->playerCharacter;
    }

    public function setPlayerCharacter(?Character $playerCharacter): self
    {
        $this->playerCharacter = $playerCharacter;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function hasItem(): bool
    {
        return true === $this->getHasItem();
    }

    public function getHasItem(): ?bool
    {
        return $this->hasItem;
    }

    public function setHasItem(bool $hasItem): self
    {
        $this->hasItem = $hasItem;

        return $this;
    }
}
