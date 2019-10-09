<?php

namespace App\Utility;

class WowSlotUtility
{
    public const SLOT_UNSPECIFIED = 0;
    public const SLOT_HEAD = 1;
    public const SLOT_NECK = 2;
    public const SLOT_SHOULDER = 3;
    public const SLOT_CHEST = 5;
    public const SLOT_BELT = 6;
    public const SLOT_LEGS = 7;
    public const SLOT_FEET = 8;
    public const SLOT_WRIST= 9;
    public const SLOT_HANDS= 10;
    public const SLOT_RINGS= 11;
    public const SLOT_TRINKETS= 12;
    public const SLOT_MAINHAND= 13;
    public const SLOT_OFFHAND= 14;
    public const SLOT_RANGED= 15;
    public const SLOT_BACK= 16;

    private const ALL = [
        self::SLOT_HEAD,
        self::SLOT_NECK,
        self::SLOT_SHOULDER,
        self::SLOT_CHEST,
        self::SLOT_BELT,
        self::SLOT_LEGS,
        self::SLOT_FEET,
        self::SLOT_WRIST,
        self::SLOT_HANDS,
        self::SLOT_RINGS,
        self::SLOT_TRINKETS,
        self::SLOT_MAINHAND,
        self::SLOT_OFFHAND,
        self::SLOT_RANGED,
        self::SLOT_BACK,
    ];
    /**
     * @param int $slotId
     * @return string
     */
    public static function getSlotName(int $slotId): string
    {
        switch ($slotId) {
            case self::SLOT_HEAD:
                return 'Head';
            case self::SLOT_NECK:
                return 'Neck';
            case self::SLOT_SHOULDER:
                return 'Shoulder';
            case self::SLOT_CHEST:
                return 'Chest';
            case self::SLOT_BELT:
                return 'Belt';
            case self::SLOT_LEGS:
                return 'Legs';
            case self::SLOT_FEET:
                return 'Feet';
            case self::SLOT_WRIST:
                return 'Wrist';
            case self::SLOT_HANDS:
                return 'Hands';
            case self::SLOT_RINGS:
                return 'Rings';
            case self::SLOT_TRINKETS:
                return 'Trinkets';
            case self::SLOT_MAINHAND:
                return 'Main Hand';
            case self::SLOT_OFFHAND:
                return 'Off Hand';
            case self::SLOT_RANGED:
                return 'Ranged';
            case self::SLOT_BACK:
                return 'Back';
            default:
                return 'Unspecified';
        }
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        $array = [];
        foreach (self::ALL as $slotId) {
            $array[$slotId] = self::getSlotName($slotId);
        }
        return $array;
    }
}