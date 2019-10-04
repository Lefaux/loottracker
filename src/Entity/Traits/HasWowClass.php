<?php


namespace App\Entity\Traits;


use App\Utility\WowClassUtility;

trait HasWowClass
{
    public function getClassName(): string
    {
        return WowClassUtility::getClassName($this->getClass());
    }

    abstract public function getClass(): ?int;
}