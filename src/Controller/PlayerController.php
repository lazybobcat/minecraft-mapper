<?php

namespace App\Controller;

use App\Entity\Player;
use App\Event\PlayerCreatedEvent;
use App\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends Controller
{
    /**
     * @Route("/player/add", name="player_add")
     */
    public function add(Request $request, EventDispatcherInterface $dispatcher)
    {
        $player = new Player();
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($player);
            $entityManager->flush();
            $dispatcher->dispatch(PlayerCreatedEvent::NAME, new PlayerCreatedEvent($player));

            return $this->redirectToRoute('map_edit');
        }

        return $this->render('player/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/player/edit/{player}", name="player_edit")
     */
    public function edit(Request $request, EventDispatcherInterface $dispatcher, Player $player)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($player);
            $entityManager->flush();
            $dispatcher->dispatch(PlayerCreatedEvent::NAME, new PlayerCreatedEvent($player));

            return $this->redirectToRoute('map_edit');
        }

        return $this->render('player/edit.html.twig', [
            'form' => $form->createView(),
            'player' => $player,
        ]);
    }
}