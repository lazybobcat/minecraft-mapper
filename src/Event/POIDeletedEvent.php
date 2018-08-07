<?php

namespace App\Event;

use App\Entity\PointOfInterest;
use Symfony\Component\EventDispatcher\Event;

class POIDeletedEvent extends Event
{
    const NAME = 'app.event.poi_deleted';

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