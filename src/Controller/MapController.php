<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\PointOfInterest;
use App\Map\Mapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends Controller
{
    /**
     * @Route("/", name="map_edit")
     */
    public function edit()
    {
        die('edit');
    }

    /**
     * @Route("/generate", name="map_generate")
     */
    public function generate(Mapper $mapper)
    {
//        $mapper->addPointOfInterest('Spawn Town', 'town', new Coord(-4503, 63, -2573), 25, 16);
//        $mapper->addPlayerHead('FacelessRobot', new Coord(-5600, 63, -3500), 25, 16);
//        $mapper->getResult('map.png');

        $players = $this->getDoctrine()->getRepository(Player::class)->findAll();
        $pois = $this->getDoctrine()->getRepository(PointOfInterest::class)->findAll();

        /** @var Player $player */
        foreach ($players as $player) {
            $mapper->addPlayerHead($player->getName(), $player->getCoords(), 22, 16);
        }

        /** @var PointOfInterest $poi */
        foreach ($pois as $poi) {
            $mapper->addPointOfInterest($poi->getName(), $poi->getType(), $poi->getCoords(), 28, 16);
        }

        $file = $mapper->getResult('map.png');

        return new BinaryFileResponse($file);
    }
}