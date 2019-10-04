<?php


namespace App\Entity\Traits;


use App\Utility\WowSpecUtility;

trait HasWowSpec
{
    public function getSpecName(): string
    {
        return WowSpecUtility::getSpecName($this->getSpec());
    }

    abstract public function getSpec(): ?int;
}