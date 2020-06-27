<?php

namespace App\Map;

use App\Entity\Player;
use App\Entity\PointOfInterest;
use Doctrine\Common\Persistence\ManagerRegistry;

class MapManager
{
    /**
     * @var Mapper
     */
    private $mapper;

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    public function __construct(Mapper $mapper, ManagerRegistry $doctrine)
    {
        $this->mapper = $mapper;
        $this->doctrine = $doctrine;
    }

    public function generate()
    {
        $players = $this->doctrine->getRepository(Player::class)->findAll();
        $pois = $this->doctrine->getRepository(PointOfInterest::class)->findAll();

        /** @var Player $player */
        foreach ($players as $player) {
            $this->mapper->addPlayerHead($player->getName(), $player->getCoords(), 22, 16);
        }

        /** @var PointOfInterest $poi */
        foreach ($pois as $poi) {
            $this->mapper->addPointOfInterest($poi->getName(), $poi->getType(), $poi->getCoords(), 28, 16);
        }

        $this->mapper->addWorldBorder(5000);

        return $this->mapper->getResult('map.png');
    }
}
