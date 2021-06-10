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
                        'className' => ['calendar-raid-weekly']
                    ]
                ));
            }
        } catch (Exception $e) {
        }
        return $calendar;
    }
}