<?php

namespace App\Event\Listener;

use App\Event\PlayerCreatedEvent;
use App\Event\PlayerDeletedEvent;
use App\Event\PlayerUpdatedEvent;
use App\Event\POICreatedEvent;
use App\Event\POIDeletedEvent;
use App\Event\POIUpdatedEvent;
use App\Map\MapManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MapGeneratorSubscriber implements EventSubscriberInterface
{
    /**
     * @var MapManager
     */
    private $manager;

    public function __construct(MapManager $manager)
    {
        $this->manager = $manager;
    }
    
    public static function getSubscribedEvents()
    {
        return [
            PlayerCreatedEvent::NAME => 'onPlayerCreated',
            PlayerUpdatedEvent::NAME => 'onPlayerUpdated',
            PlayerDeletedEvent::NAME => 'onPlayerDeleted',
            POICreatedEvent::NAME => 'onPOICreated',
            POIUpdatedEvent::NAME => 'onPOIUpdated',
            POIDeletedEvent::NAME => 'onPOIDeleted',
        ];
    }

    public function onPlayerCreated(PlayerCreatedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }

    public function onPlayerUpdated(PlayerUpdatedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }

    public function onPlayerDeleted(PlayerDeletedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }

    public function onPOICreated(POICreatedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }

    public function onPOIUpdated(POIUpdatedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }

    public function onPOIDeleted(POIDeletedEvent $event)
    {
        try {
            $this->manager->generate();
        } catch (\Exception $e) {}
    }
}