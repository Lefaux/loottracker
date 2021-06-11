<?php

namespace App\Utility;

use App\Repository\ZoneRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class WoWZoneUtility
{
    private static $zoneRepository;

    private static $request;

    public function __construct(ZoneRepository $zoneRepository, RequestStack $requestStack)
    {
        self::$zoneRepository = $zoneRepository;
        self::$request = $requestStack;
    }

    public static function getZoneName($zoneId): string
    {
        if ($zoneId === null) {
            return '-';
        }
        $locale = self::$request->getCurrentRequest()->getLocale();
        $zone = self::$zoneRepository->find($zoneId);
        if ($zone === null) {
            return '-';
        }
        if ($locale === 'de') {
            return $zone->getDe();
        }
        return $zone->getName();
    }
}
