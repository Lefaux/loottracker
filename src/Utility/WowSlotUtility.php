<?php

namespace App\Utility;

use Symfony\Contracts\Translation\TranslatorInterface;

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
     * @var TranslatorInterface
     */
    private static $translator;

    public function __construct(TranslatorInterface $translator)
    {
        self::$translator = $translator;
    }
    /**
     * @param int $slotId
     * @return string
     */
    public static function getSlotName(int $slotId): string
    {
        switch ($slotId) {
            case self::SLOT_HEAD:
                return self::$translator->trans('Head');
            case self::SLOT_NECK:
                return self::$translator->trans('Neck');
            case self::SLOT_SHOULDER:
                return self::$translator->trans('Shoulder');
            case self::SLOT_CHEST:
                return self::$translator->trans('Chest');
            case self::SLOT_BELT:
                return self::$translator->trans('Belt');
            case self::SLOT_LEGS:
                return self::$translator->trans('Legs');
            case self::SLOT_FEET:
                return self::$translator->trans('Feet');
            case self::SLOT_WRIST:
                return self::$translator->trans('Wrist');
            case self::SLOT_HANDS:
                return self::$translator->trans('Hands');
            case self::SLOT_RINGS:
                return self::$translator->trans('Rings');
            case self::SLOT_TRINKETS:
                return self::$translator->trans('Trinkets');
            case self::SLOT_MAINHAND:
                return self::$translator->trans('Main Hand');
            case self::SLOT_OFFHAND:
                return self::$translator->trans('Off Hand');
            case self::SLOT_RANGED:
                return self::$translator->trans('Ranged');
            case self::SLOT_BACK:
                return self::$translator->trans('Back');
            default:
                return self::$translator->trans('Unspecified');
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