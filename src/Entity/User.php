<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playername;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getPlayername(): ?string
    {
        return $this->playername;
    }

    public function setPlayername(?string $playername): self
    {
        $this->playername = $playername;

        return $this;
    }
}