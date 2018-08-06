<?php

namespace App\Controller;

use App\Map\Coord;
use App\Map\Mapper;
use App\Mojang\MojangAPI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends Controller
{
    /**
     * @Route("/", name="map")
     */
    public function index(MojangAPI $mojangAPI, Mapper $mapper)
    {
//        $uuid = $mojangAPI->getUuid('FacelessRobot');
//        $head = $mojangAPI->getPlayerHead($uuid);
//
//        echo "<img src=\"{$mojangAPI->embedImage($head)}\">";
        $coords = $mapper->blockToPixelCoords(new Coord(-4503, 63, -2573));
        echo "Town in px: {$coords->x},{$coords->z}";
        die();
    }
}