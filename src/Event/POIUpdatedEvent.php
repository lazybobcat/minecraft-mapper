<?php

namespace App\Event;

use App\Entity\PointOfInterest;
use Symfony\Component\EventDispatcher\Event;

class POIUpdatedEvent extends Event
{
    const NAME = 'app.event.poi_updated';

    /**
     * @var PointOfInterest
     */
    private $player;


    public function __construct(PointOfInterest $player)
    {
        $this->player = $player;
    }

    /**
     * @return PointOfInterest
     */
    public function getPlayer()
    {
        return $this->player;
    }
}