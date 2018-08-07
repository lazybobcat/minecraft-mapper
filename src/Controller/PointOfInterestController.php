<?php

namespace App\Controller;

use App\Entity\PointOfInterest;
use App\Event\POICreatedEvent;
use App\Event\POIDeletedEvent;
use App\Event\POIUpdatedEvent;
use App\Form\PointOfInterestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PointOfInterestController extends Controller
{
    /**
     * @Route("/poi/add", name="poi_add")
     */
    public function add(Request $request, EventDispatcherInterface $dispatcher)
    {
        $poi = new PointOfInterest();
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(PointOfInterestType::class, $poi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($poi);
            $entityManager->flush();
            $dispatcher->dispatch(POICreatedEvent::NAME, new POICreatedEvent($poi));

            return $this->redirectToRoute('map_edit');
        }

        return $this->render('poi/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/poi/edit/{poi}", name="poi_edit")
     */
    public function edit(Request $request, EventDispatcherInterface $dispatcher, PointOfInterest $poi)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(PointOfInterestType::class, $poi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($poi);
            $entityManager->flush();
            $dispatcher->dispatch(POIUpdatedEvent::NAME, new POIUpdatedEvent($poi));

            return $this->redirectToRoute('map_edit');
        }

        return $this->render('poi/edit.html.twig', [
            'form' => $form->createView(),
            'poi' => $poi,
        ]);
    }

    /**
     * @Route("/poi/delete/{poi}", name="poi_delete")
     */
    public function delete(Request $request, EventDispatcherInterface $dispatcher, PointOfInterest $poi)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->remove($poi);
            $entityManager->flush();

            $dispatcher->dispatch(POIDeletedEvent::NAME, new POIDeletedEvent($poi));

            return $this->redirectToRoute('map_edit');
        }

        return $this->render('poi/delete.html.twig', [
            'form' => $form->createView(),
            'poi' => $poi,
        ]);
    }
}