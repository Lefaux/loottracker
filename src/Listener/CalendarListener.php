<?php


namespace App\Listener;


use App\Repository\RaidEventRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarListener
{
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(RaidEventRepository $raidEventRepository, UrlGeneratorInterface $router)
    {
        $this->raidEventRepository = $raidEventRepository;
        $this->router = $router;
    }

    public function load(CalendarEvent $calendar): void
    {

        $events = $this->raidEventRepository->findEventsInGivenMonth($calendar->getStart(), $calendar->getEnd());

        foreach ($events as $event) {
            $calendar->addEvent(new Event(
                $event->getTitle(),
                $event->getStart(),
                $event->getStart(),
                [
                    'url' => $this->router->generate('raid_signup', ['event' => $event->getId()])
                ]
            ));
        }
        $calendar = $this->setOnyResets($calendar);
        $calendar = $this->setZgResets($calendar);
        $this->setMcResets($calendar);

    }

    public function setMcResets(CalendarEvent $calendar): CalendarEvent
    {
        try {
            $mcResets = new DatePeriod(
                $calendar->getStart(),
                DateInterval::createFromDateString('next wednesday'),
                7,
                DatePeriod::EXCLUDE_START_DATE
            );
            foreach ($mcResets as $index => $mcReset) {
                $calendar->addEvent(new Event(
                    'MC',
                    $mcReset,
                    null,
                    [
                        'rendering' => 'background',
                        'className' => ['calendar-raid-40']
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
            
            $onyResets = new DatePeriod(
                $startDateInCalendarView,
                new DateInterval('P5D'),
                $calendar->getEnd()
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

    public function setZgResets(CalendarEvent $calendar): CalendarEvent
    {
        $initialReset = new DateTime('2020-04-16 05:00:00');
        $differenceInDays = $initialReset->diff($calendar->getStart())->format('%a');
        $differenceToCalenderStart = (int)floor($differenceInDays / 3) * 3;
        try {
            if ($calendar->getStart()->format('m') === '03') {
                $startDateInCalendarView = $initialReset;
            } else {
                $startDateInCalendarView = $initialReset->add(new DateInterval('P' . $differenceToCalenderStart . 'D'));
            }

            $onyResets = new DatePeriod(
                $startDateInCalendarView,
                new DateInterval('P3D'),
                $calendar->getEnd()
            );
            foreach ($onyResets as $index => $mcReset) {
                $calendar->addEvent(new Event(
                    'ZG',
                    $mcReset,
                    null,
                    [
                        'rendering' => 'background',
                        'className' => ['calendar-raid-zg']
                    ]
                ));
            }
        } catch (Exception $e) {
        }


        return $calendar;
    }
}