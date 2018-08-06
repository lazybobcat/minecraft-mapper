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
        $mapper->addPlayerHead('FacelessRobot', new Coord(-4503, 63, -2573), 25, 16);
        $mapper->getResult('map.png');

        die();
    }
}