<?php


namespace App\Utility;


class WowSpecUtility
{
    public const SPEC_UNSPECIFIED = 0;
    public const SPEC_TANK = 1;
    public const SPEC_HEALER = 2;
    public const SPEC_DPS = 3;

    public const ALL = [
        self::SPEC_UNSPECIFIED,
        self::SPEC_TANK,
        self::SPEC_HEALER,
        self::SPEC_DPS,
    ];

    /**
     * @param int $specId
     * @return string
     */
    public static function getSpecName(int $specId): string
    {
        switch ($specId) {
            case self::SPEC_TANK:
                return 'Tank';
            case self::SPEC_HEALER:
                return 'Healer';
            case self::SPEC_DPS:
                return 'DPS';
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
        foreach (self::ALL as $specId) {
            $array[$specId] = self::getSpecName($specId);
        }
        return $array;
    }
}