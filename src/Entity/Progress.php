<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgressRepository")
 */
class Progress
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
    private $instance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $clearTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstance(): ?int
    {
        return $this->instance;
    }

    public function setInstance(int $instance): self
    {
        $this->instance = $instance;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClearTime(): ?int
    {
        return $this->clearTime;
    }

    public function setClearTime(int $clearTime): self
    {
        $this->clearTime = $clearTime;

        return $this;
    }
}
