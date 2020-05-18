<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecruitmentEntryRepository")
 */
class RecruitmentEntry
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
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $demand;

    /**
     * @ORM\Column(type="integer")
     */
    private $spec;

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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDemand(): ?int
    {
        return $this->demand;
    }

    public function setDemand(int $demand): self
    {
        $this->demand = $demand;

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
}
