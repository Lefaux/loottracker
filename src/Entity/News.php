<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
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
    private $publishedOn;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NewsCategory", inversedBy="news")
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $abstract;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverimage;

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

    public function getPublishedOn(): ?\DateTimeInterface
    {
        return $this->publishedOn;
    }

    public function setPublishedOn(\DateTimeInterface $publishedOn): self
    {
        $this->publishedOn = $publishedOn;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?NewsCategory
    {
        return $this->category;
    }

    public function setCategory(?NewsCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getCoverimage(): ?string
    {
        return $this->coverimage;
    }

    public function setCoverimage(?string $coverimage): self
    {
        $this->coverimage = $coverimage;

        return $this;
    }
}
