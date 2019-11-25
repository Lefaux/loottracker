<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaidEventRepository")
 */
class RaidEvent
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Signup", mappedBy="raidEvent")
     */
    private $signups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RaidGroup", mappedBy="event")
     */
    private $raidGroups;

    public function __construct()
    {
        $this->signups = new ArrayCollection();
        $this->raidGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Collection|Signup[]
     */
    public function getSignups(): Collection
    {
        return $this->signups;
    }

    public function addSignup(Signup $signup): self
    {
        if (!$this->signups->contains($signup)) {
            $this->signups[] = $signup;
            $signup->setRaidEvent($this);
        }

        return $this;
    }

    public function removeSignup(Signup $signup): self
    {
        if ($this->signups->contains($signup)) {
            $this->signups->removeElement($signup);
            // set the owning side to null (unless already changed)
            if ($signup->getRaidEvent() === $this) {
                $signup->setRaidEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RaidGroup[]
     */
    public function getRaidGroups(): Collection
    {
        return $this->raidGroups;
    }

    public function addRaidGroup(RaidGroup $raidGroup): self
    {
        if (!$this->raidGroups->contains($raidGroup)) {
            $this->raidGroups[] = $raidGroup;
            $raidGroup->setEvent($this);
        }

        return $this;
    }

    public function removeRaidGroup(RaidGroup $raidGroup): self
    {
        if ($this->raidGroups->contains($raidGroup)) {
            $this->raidGroups->removeElement($raidGroup);
            // set the owning side to null (unless already changed)
            if ($raidGroup->getEvent() === $this) {
                $raidGroup->setEvent(null);
            }
        }

        return $this;
    }
}
