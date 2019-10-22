<?php


namespace App\Utility;


use Symfony\Contracts\Translation\TranslatorInterface;

class WowClassUtility
{
    public const CLASS_UNSPECIFIED = 0;
    public const CLASS_WARRIOR = 1;
    public const CLASS_PRIEST = 2;
    public const CLASS_MAGE = 3;
    public const CLASS_WARLOCK = 4;
    public const CLASS_ROGUE = 5;
    public const CLASS_DRUID = 6;
    public const CLASS_HUNTER = 7;
    public const CLASS_SHAMAN = 8;
    public const CLASS_PALADIN = 9;

    private const ALL = [
        self::CLASS_UNSPECIFIED,
        self::CLASS_WARRIOR,
        self::CLASS_PRIEST,
        self::CLASS_MAGE,
        self::CLASS_WARLOCK,
        self::CLASS_ROGUE,
        self::CLASS_DRUID,
        self::CLASS_HUNTER,
        self::CLASS_SHAMAN,
        self::CLASS_PALADIN,
    ];

    /**
     * @param int $classId
     * @param TranslatorInterface $translator
     * @return string
     */
    public static function getClassName(int $classId, TranslatorInterface $translator): string
    {
        switch ($classId) {
            case self::CLASS_WARRIOR:
                return $translator->trans('Warrior');
            case self::CLASS_PRIEST:
                return 'Priest';
            case self::CLASS_MAGE:
                return 'Mage';
            case self::CLASS_WARLOCK:
                return 'Warlock';
            case self::CLASS_ROGUE:
                return 'Rogue';
            case self::CLASS_DRUID:
                return 'Druid';
            case self::CLASS_HUNTER:
                return 'Hunter';
            case self::CLASS_SHAMAN:
                return 'Shaman';
            case self::CLASS_PALADIN:
                return 'Paladin';
            default:
                return 'Unspecified';
        }
    }

    /**
     * @param TranslatorInterface $translator
     * @return array
     */
    public static function toArray(TranslatorInterface $translator): array
    {
        $array = [];
        foreach (self::ALL as $roleId) {
            $array[$roleId] = self::getClassName($roleId, $translator);
        }
        return $array;
    }
}