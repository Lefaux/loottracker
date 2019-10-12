<?php


namespace App\Listener;


use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

class CalendarListener
{
    public function load(CalendarEvent $calendar): void
    {
        $calendar = $this->setMcResets($calendar);

        $calendar->addEvent(new Event(
            'Event 1',
            new DateTime('Tuesday this week'),
            new DateTime('Wednesdays this week')
        ));

        // If the end date is null or not defined, it creates a all day event
        $calendar->addEvent(new Event(
            'All day event',
            new DateTime('Friday next week'),
            null,
            [
                'rendering' => 'background',
                'className' => ['calendar-raid-onyxia']
            ]
        ));
    }

    public function setMcResets(CalendarEvent $calendar): CalendarEvent
    {
        $fixedMonth = $calendar->getStart();
        if ($calendar->getStart()->format('d') !== '01') {
            $fixedMonth->modify('first day of next month');
        }
        try {
            $mcResets = new DatePeriod(
                new DateTime('first wednesday of ' . $fixedMonth->format('Y-m')),
                DateInterval::createFromDateString('next wednesday'),
                new DateTime('last day of ' . $fixedMonth->format('Y-m'))
            );
            foreach ($mcResets as $index => $mcReset) {
                $calendar->addEvent(new Event(
                    'All day event',
                    $mcReset,
                    null,
                    [
                        'rendering' => 'background',
                        'className' => ['calendar-raid-moltencore']
                    ]
                ));
            }
        } catch (Exception $e) {
        }
        return $calendar;
    }
}