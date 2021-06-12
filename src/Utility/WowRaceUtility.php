<?php


namespace App\Utility;


use Symfony\Contracts\Translation\TranslatorInterface;

class WowRaceUtility
{
    public const RACE_UNSPECIFIED = 0;
    public const RACE_NIGHTELF = 1;
    public const RACE_HUMAN = 2;
    public const RACE_DWARF = 3;
    public const RACE_GNOME = 4;
    public const RACE_DRAENAI = 5;

    public const ALL = [
        self::RACE_UNSPECIFIED,
        self::RACE_NIGHTELF,
        self::RACE_HUMAN,
        self::RACE_DWARF,
        self::RACE_GNOME,
        self::RACE_DRAENAI
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
     * @param $raceId
     * @return string
     */
    public static function getRaceName($raceId): string
    {
        switch ($raceId) {
            case self::RACE_NIGHTELF:
                return self::$translator->trans('Nightelf');
            case self::RACE_HUMAN:
                return self::$translator->trans('Human');
            case self::RACE_DWARF:
                return self::$translator->trans('Dwarf');
            case self::RACE_GNOME:
                return self::$translator->trans('Gnome');
            case self::RACE_DRAENAI:
                return self::$translator->trans('Draenai');
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
        foreach (self::ALL as $raceId) {
            $array[$raceId] = self::getRaceName($raceId);
        }
        return $array;
    }
}