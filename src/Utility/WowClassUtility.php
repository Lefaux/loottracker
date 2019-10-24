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
     * @var TranslatorInterface
     */
    private static $translator;

    public function __construct(TranslatorInterface $translator)
    {
        self::$translator = $translator;
    }

    /**
     * @param int $classId
     * @return string
     */
    public static function getClassName(int $classId): string
    {
        switch ($classId) {
            case self::CLASS_WARRIOR:
                return self::$translator->trans('Warrior');
            case self::CLASS_PRIEST:
                return self::$translator->trans('Priest');
            case self::CLASS_MAGE:
                return self::$translator->trans('Mage');
            case self::CLASS_WARLOCK:
                return self::$translator->trans('Warlock');
            case self::CLASS_ROGUE:
                return self::$translator->trans('Rogue');
            case self::CLASS_DRUID:
                return self::$translator->trans('Druid');
            case self::CLASS_HUNTER:
                return self::$translator->trans('Hunter');
            case self::CLASS_SHAMAN:
                return self::$translator->trans('Shaman');
            case self::CLASS_PALADIN:
                return self::$translator->trans('Paladin');
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
        foreach (self::ALL as $roleId) {
            $array[$roleId] = self::getClassName($roleId);
        }
        return $array;
    }
}