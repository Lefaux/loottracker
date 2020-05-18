<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('secondsToTime', [$this, 'secondsToTime'])
        ];
    }

    public function secondsToTime($seconds): string
    {
        if ($seconds === 0) {
            return '--:--';
        }
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds %= 60;
        return $hours > 0 ? "$hours:$minutes:$seconds" : "$minutes:$seconds";
    }
}