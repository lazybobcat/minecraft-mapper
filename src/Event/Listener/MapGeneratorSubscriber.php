<?php

namespace App\Event\Listener;

use App\Event\PlayerCreatedEvent;
use App\Event\PlayerDeletedEvent;
use App\Event\PlayerUpdatedEvent;
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
}