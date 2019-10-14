<?php


namespace App\Listener;


use App\Repository\RaidEventRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

class CalendarListener
{
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;

    public function __construct(RaidEventRepository $raidEventRepository)
    {
        $this->raidEventRepository = $raidEventRepository;
    }

    public function load(CalendarEvent $calendar): void
    {
        $calendar = $this->setMcResets($calendar);
        $calendar = $this->setOnyResets($calendar);

        $events = $this->raidEventRepository->findEventsInGivenMonth($calendar->getStart(), $calendar->getEnd());

        foreach ($events as $event) {
            $calendar->addEvent(new Event(
                $event->getTitle(),
                $event->getStart(),
                $event->getEnd(),
                [
                    'eventColor' => '#ff00ff'
                ]
            ));
        }

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
                    'MC',
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

    public function setOnyResets(CalendarEvent $calendar): CalendarEvent
    {
        $initialReset = new DateTime('2019-09-26 05:00:00');
        $differenceInDays = $initialReset->diff($calendar->getStart())->format('%a');
        $differenceToCalenderStart = (int)floor($differenceInDays / 5) * 5;
        try {
            $startDateInCalendarView = $initialReset->add(new DateInterval('P' . $differenceToCalenderStart . 'D'));

            $fixedMonth = $calendar->getStart();
            if ($calendar->getStart()->format('d') !== '01') {
                $fixedMonth->modify('first day of next month');
            }
            $onyResets = new DatePeriod(
                $startDateInCalendarView,
                new DateInterval('P5D'),
                new DateTime('last day of ' . $fixedMonth->format('Y-m'))
            );
            foreach ($onyResets as $index => $mcReset) {
                $calendar->addEvent(new Event(
                    'OL',
                    $mcReset,
                    null,
                    [
                        'rendering' => 'background',
                        'className' => ['calendar-raid-onyxia']
                    ]
                ));
            }
        } catch (Exception $e) {
        }


        return $calendar;
    }
}