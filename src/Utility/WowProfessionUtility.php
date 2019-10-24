<?php


namespace App\Utility;


use Symfony\Contracts\Translation\TranslatorInterface;

class WowProfessionUtility
{
    public const PROFESSION_UNSPECIFIED = 0;
    public const PROFESSION_ALCHEMY = 1;
    public const PROFESSION_ARMORSMITH= 2;
    public const PROFESSION_WEAPONSMITH = 3;
    public const PROFESSION_ENCHANTING = 4;
    public const PROFESSION_ENGINEERING = 5;
    public const PROFESSION_HERBALISM = 6;
    public const PROFESSION_MINING = 7;
    public const PROFESSION_SKINNING = 8;
    public const PROFESSION_TAILORING = 9;
    public const PROFESSION_LW_DRAGON = 10;
    public const PROFESSION_LW_TRIBAL = 11;
    public const PROFESSION_LW_ELEMENTAL = 12;

    private const ALL = [
        self::PROFESSION_UNSPECIFIED,
        self::PROFESSION_ALCHEMY,
        self::PROFESSION_ARMORSMITH,
        self::PROFESSION_WEAPONSMITH,
        self::PROFESSION_ENCHANTING,
        self::PROFESSION_ENGINEERING,
        self::PROFESSION_HERBALISM,
        self::PROFESSION_MINING,
        self::PROFESSION_SKINNING,
        self::PROFESSION_TAILORING,
        self::PROFESSION_LW_DRAGON,
        self::PROFESSION_LW_TRIBAL,
        self::PROFESSION_LW_ELEMENTAL,
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
     * @param int $professionId
     * @return string
     */
    public static function getProfessionName(int $professionId): string
    {
        switch ($professionId) {
            case self::PROFESSION_ALCHEMY:
                return self::$translator->trans('Alchemy');
            case self::PROFESSION_ARMORSMITH:
                return self::$translator->trans('Armorsmith');
            case self::PROFESSION_WEAPONSMITH:
                return self::$translator->trans('Weaponsmith');
            case self::PROFESSION_ENCHANTING:
                return self::$translator->trans('Enchanting');
            case self::PROFESSION_ENGINEERING:
                return self::$translator->trans('Engineering');
            case self::PROFESSION_HERBALISM:
                return self::$translator->trans('Herbalism');
            case self::PROFESSION_MINING:
                return self::$translator->trans('Mining');
            case self::PROFESSION_SKINNING:
                return self::$translator->trans('Skinning');
            case self::PROFESSION_TAILORING:
                return self::$translator->trans('Tailoring');
            case self::PROFESSION_LW_DRAGON:
                return self::$translator->trans('Dragonscale Leatherworker');
            case self::PROFESSION_LW_TRIBAL:
                return self::$translator->trans('Tribal Leatherworker');
            case self::PROFESSION_LW_ELEMENTAL:
                return self::$translator->trans('Elemental Leatherworker');
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
        foreach (self::ALL as $professionId) {
            $array[$professionId] = self::getProfessionName($professionId);
        }
        return $array;
    }
}