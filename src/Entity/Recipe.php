<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Item")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Player;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Item
    {
        return $this->recipe;
    }

    public function setRecipe(?Item $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getPlayer(): ?Character
    {
        return $this->Player;
    }

    public function setPlayer(?Character $Player): self
    {
        $this->Player = $Player;

        return $this;
    }
}
