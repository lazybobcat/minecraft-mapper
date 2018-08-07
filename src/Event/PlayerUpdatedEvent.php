<?php

namespace App\Event;

use App\Entity\Player;
use Symfony\Component\EventDispatcher\Event;

class PlayerUpdatedEvent extends Event
{
    const NAME = 'app.event.player_updated';

    /**
     * @var Player
     */
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}