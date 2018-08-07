<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\PointOfInterest;
use App\Map\MapManager;
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
        $players = $this->getDoctrine()->getRepository(Player::class)->findBy([], ['name' => 'ASC']);
        $pois = $this->getDoctrine()->getRepository(PointOfInterest::class)->findAll();


        return $this->render('map/edit.html.twig', [
            'players' => $players,
            'pois' => $pois,
        ]);
    }

    /**
     * @Route("/generate", name="map_generate")
     */
    public function generate(MapManager $manager)
    {
        $file = $manager->generate();

        return new BinaryFileResponse($file);
    }
}