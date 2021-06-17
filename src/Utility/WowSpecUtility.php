<?php


namespace App\Utility;


use Symfony\Contracts\Translation\TranslatorInterface;

class WowSpecUtility
{
    public const SPEC_UNSPECIFIED = 0;
    public const SPEC_TANK = 1;
    public const SPEC_HEALER = 2;
    public const SPEC_DPS = 3;
    public const SPEC_DRUID_BALANCE = 4;
    public const SPEC_DRUID_FERAL = 5;
    public const SPEC_DRUID_RESTORATION = 6;
    public const SPEC_HUNTER_BEASTMASTERY = 7;
    public const SPEC_HUNTER_MARKSMANSHIP = 8;
    public const SPEC_HUNTER_SURVIVAL = 9;
    public const SPEC_MAGE_ARCANE = 10;
    public const SPEC_MAGE_FIRE = 11;
    public const SPEC_MAGE_FROST = 12;
    public const SPEC_PALADIN_HOLY = 13;
    public const SPEC_PALADIN_PROTECTION = 14;
    public const SPEC_PALADIN_RETRIBUTION = 15;
    public const SPEC_PRIEST_DISCIPLINE = 16;
    public const SPEC_PRIEST_HOLY = 17;
    public const SPEC_PRIEST_SHADOW = 18;
    public const SPEC_ROGUE_ASSASSINATION = 19;
    public const SPEC_ROGUE_COMBAT = 20;
    public const SPEC_ROGUE_SUBTLETY = 21;
    public const SPEC_SHAMAN_ELEMENTAL = 22;
    public const SPEC_SHAMAN_ENHANCEMENT = 23;
    public const SPEC_SHAMAN_RESTORATION = 24;
    public const SPEC_WARLOCK_AFFLICTION = 25;
    public const SPEC_WARLOCK_DEMONOLOGY = 26;
    public const SPEC_WARLOCK_DESTRUCTION = 27;
    public const SPEC_WARRIOR_ARMS = 28;
    public const SPEC_WARRIOR_FURY = 29;
    public const SPEC_WARRIOR_PROTECTION = 30;


    public const ALL = [
        self::SPEC_UNSPECIFIED,
        self::SPEC_TANK,
        self::SPEC_HEALER,
        self::SPEC_DPS,
        self::SPEC_DRUID_BALANCE,
        self::SPEC_DRUID_FERAL,
        self::SPEC_DRUID_RESTORATION,
        self::SPEC_HUNTER_BEASTMASTERY,
        self::SPEC_HUNTER_MARKSMANSHIP,
        self::SPEC_HUNTER_SURVIVAL,
        self::SPEC_MAGE_ARCANE,
        self::SPEC_MAGE_FIRE,
        self::SPEC_MAGE_FROST,
        self::SPEC_PALADIN_HOLY,
        self::SPEC_PALADIN_PROTECTION,
        self::SPEC_PALADIN_RETRIBUTION,
        self::SPEC_PRIEST_DISCIPLINE,
        self::SPEC_PRIEST_HOLY,
        self::SPEC_PRIEST_SHADOW,
        self::SPEC_ROGUE_ASSASSINATION,
        self::SPEC_ROGUE_COMBAT,
        self::SPEC_ROGUE_SUBTLETY,
        self::SPEC_SHAMAN_ELEMENTAL,
        self::SPEC_SHAMAN_ENHANCEMENT,
        self::SPEC_SHAMAN_RESTORATION,
        self::SPEC_WARLOCK_AFFLICTION,
        self::SPEC_WARLOCK_DEMONOLOGY,
        self::SPEC_WARLOCK_DESTRUCTION,
        self::SPEC_WARRIOR_ARMS,
        self::SPEC_WARRIOR_FURY,
        self::SPEC_WARRIOR_PROTECTION
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
     * @param int $specId
     * @return string
     */
    public static function getSpecName(int $specId): string
    {
        switch ($specId) {
            case self::SPEC_TANK:
                return self::$translator->trans('Tank');
            case self::SPEC_HEALER:
                return self::$translator->trans('Healer');
            case self::SPEC_DPS:
                return self::$translator->trans('DPS');
            case self::SPEC_DRUID_BALANCE:
                return self::$translator->trans('Balance Druid');
            case self::SPEC_DRUID_FERAL:
                return self::$translator->trans('Feral Druid');
            case self::SPEC_DRUID_RESTORATION:
                return self::$translator->trans('Restoration Druid');
            case self::SPEC_HUNTER_BEASTMASTERY:
                return self::$translator->trans('Beast Master Hunter');
            case self::SPEC_HUNTER_MARKSMANSHIP:
                return self::$translator->trans('Marksman Hunter');
            case self::SPEC_HUNTER_SURVIVAL:
                return self::$translator->trans('Survival Hunter');
            case self::SPEC_MAGE_ARCANE:
                return self::$translator->trans('Arcane Mage');
            case self::SPEC_MAGE_FIRE:
                return self::$translator->trans('Fire Mage');
            case self::SPEC_MAGE_FROST:
                return self::$translator->trans('Frost Mage');
            case self::SPEC_PALADIN_HOLY:
                return self::$translator->trans('Holy Paladin');
            case self::SPEC_PALADIN_PROTECTION:
                return self::$translator->trans('Protection Paladin');
            case self::SPEC_PALADIN_RETRIBUTION:
                return self::$translator->trans('Retribution Paladin');
            case self::SPEC_PRIEST_DISCIPLINE:
                return self::$translator->trans('Discipline Priest');
            case self::SPEC_PRIEST_HOLY:
                return self::$translator->trans('Holy Priest');
            case self::SPEC_PRIEST_SHADOW:
                return self::$translator->trans('Shadow Priest');
            case self::SPEC_ROGUE_ASSASSINATION:
                return self::$translator->trans('Assassination Rogue');
            case self::SPEC_ROGUE_COMBAT:
                return self::$translator->trans('Combat Rogue');
            case self::SPEC_ROGUE_SUBTLETY:
                return self::$translator->trans('Subtelty Rogue');
            case self::SPEC_SHAMAN_ELEMENTAL:
                return self::$translator->trans('Elemental Shaman');
            case self::SPEC_SHAMAN_ENHANCEMENT:
                return self::$translator->trans('Enhancement Shaman');
            case self::SPEC_SHAMAN_RESTORATION:
                return self::$translator->trans('Restoration Shaman');
            case self::SPEC_WARLOCK_AFFLICTION:
                return self::$translator->trans('Affliction Warlock');
            case self::SPEC_WARLOCK_DEMONOLOGY:
                return self::$translator->trans('Demonology Warlock');
            case self::SPEC_WARLOCK_DESTRUCTION:
                return self::$translator->trans('Destruction Warlock');
            case self::SPEC_WARRIOR_ARMS:
                return self::$translator->trans('Arms Warrior');
            case self::SPEC_WARRIOR_FURY:
                return self::$translator->trans('Fury Warrior');
            case self::SPEC_WARRIOR_PROTECTION:
                return self::$translator->trans('Protection Warrior');
            default:
                return self::$translator->trans('Unspecified');
        }
    }

    /**
     * @param int $specId
     * @return string
     */
    public static function getMetaSpecName(int $specId): string
    {
        switch ($specId) {
            case self::SPEC_TANK:
            case self::SPEC_DRUID_FERAL:
            case self::SPEC_PALADIN_PROTECTION:
            case self::SPEC_WARRIOR_PROTECTION:
                return 100;
            case self::SPEC_HEALER:
            case self::SPEC_DRUID_RESTORATION:
            case self::SPEC_PALADIN_HOLY:
            case self::SPEC_PRIEST_DISCIPLINE:
            case self::SPEC_PRIEST_HOLY:
            case self::SPEC_SHAMAN_RESTORATION:
                return 200;
            case self::SPEC_DPS:
            case self::SPEC_PALADIN_RETRIBUTION:
            case self::SPEC_ROGUE_ASSASSINATION:
            case self::SPEC_ROGUE_COMBAT:
            case self::SPEC_ROGUE_SUBTLETY:
            case self::SPEC_SHAMAN_ENHANCEMENT:
            case self::SPEC_WARRIOR_ARMS:
            case self::SPEC_WARRIOR_FURY:
                return 300;
            case self::SPEC_DRUID_BALANCE:
            case self::SPEC_HUNTER_BEASTMASTERY:
            case self::SPEC_HUNTER_MARKSMANSHIP:
            case self::SPEC_HUNTER_SURVIVAL:
            case self::SPEC_MAGE_ARCANE:
            case self::SPEC_MAGE_FIRE:
            case self::SPEC_MAGE_FROST:
            case self::SPEC_PRIEST_SHADOW:
            case self::SPEC_SHAMAN_ELEMENTAL:
            case self::SPEC_WARLOCK_AFFLICTION:
            case self::SPEC_WARLOCK_DEMONOLOGY:
            case self::SPEC_WARLOCK_DESTRUCTION:
                return 400;
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
        foreach (self::ALL as $specId) {
            $array[$specId] = self::getSpecName($specId);
        }
        return $array;
    }
}