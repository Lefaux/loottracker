<?php


namespace App\Utility;


class WowRaceUtility
{
    public const RACE_UNSPECIFIED = 0;
    public const RACE_NIGHTELF = 1;
    public const RACE_HUMAN = 2;
    public const RACE_DWARF = 3;
    public const RACE_GNOME = 4;

    public const ALL = [
        self::RACE_UNSPECIFIED,
        self::RACE_NIGHTELF,
        self::RACE_HUMAN,
        self::RACE_DWARF,
        self::RACE_GNOME
    ];

    /**
     * @param int $raceId
     * @return string
     */
    public static function getRaceName(int $raceId): string
    {
        switch ($raceId) {
            case self::RACE_NIGHTELF:
                return 'Nightelf';
            case self::RACE_HUMAN:
                return 'Human';
            case self::RACE_DWARF:
                return 'Dwarf';
            case self::RACE_GNOME:
                return 'Gnome';
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
        foreach (self::ALL as $raceId) {
            $array[$raceId] = self::getRaceName($raceId);
        }
        return $array;
    }
}