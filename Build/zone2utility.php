<?php

$textFile = file('./config/zones.txt');

$constants = [];
$cases = [];

$pattern = '/(?<zoneId>\d{1,4})\s(?<zoneName>.*)\s=/m';

function normalizeName(string $name) {
    $searches = [
        '\'',
        ' ',
        '-',
        '.',
        ':'
    ];
    $normalizedName = strtoupper(str_replace($searches, '', $name));
    return $normalizedName;
}

$phpFileContent = '<?php

namespace App\Utility;

class WoWZoneUtility
{

';

foreach ($textFile as $line) {
    preg_match($pattern, $line, $matches);
    $constants[normalizeName($matches['zoneName'])] = '    public const ZONE_' . normalizeName($matches['zoneName']) . ' = ' . (int)$matches['zoneId'] . ';';
    $cases[normalizeName($matches['zoneName'])] = '            case self::ZONE_' . normalizeName($matches['zoneName']) . ':
                return \'' . str_replace("'","\'", $matches['zoneName']) . '\';';
}
$phpFileContent .= implode(chr(10), $constants);

$phpFileContent .= '

    public static function getZoneName($zoneId): string
    {
        switch ($zoneId) {
'.implode(chr(10), $cases).'
            default:
                return \'Unspecified\';
        }
    
    }
}
';


$phpFileContent .= '';

file_put_contents('src/Utility/WoWZoneUtility.php', $phpFileContent);