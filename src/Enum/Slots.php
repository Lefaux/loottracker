<?php


namespace App\Enum;


class Slots
{
    public const SLOT_HEAD = 1;
    public const SLOT_NECK = 2;

    public const SLOTS = [
        self::SLOT_HEAD => 'Head',
        self::SLOT_NECK => 'Neck',
        // etc
    ];
}