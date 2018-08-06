<?php

namespace App\Controller;

use App\Map\Coord;
use App\Map\Mapper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends Controller
{
    /**
     * @Route("/", name="map")
     */
    public function index(Mapper $mapper)
    {
        $mapper->addTown('Spawn Town', new Coord(-4503, 63, -2573), 25, 16);
        $mapper->addPlayerHead('FacelessRobot', new Coord(-5600, 63, -3500), 25, 16);
        $mapper->getResult('map.png');

        die();
    }
}