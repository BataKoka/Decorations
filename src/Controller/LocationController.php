<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * @Route("/", name="location_index", methods="GET")
     */
    public function index(): Response
    {
        $locations = $this->getDoctrine()
            ->getRepository(Location::class)
            ->findAll();

        return $this->render('location/index.html.twig', ['locations' => $locations]);
    }

    /**
     * @Route("/new", name="location_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('location_index');
        }

        return $this->render('location/new.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="location_show", methods="GET")
//     */
//    public function show(Location $location): Response
//    {
//        return $this->render('location/show.html.twig', ['location' => $location]);
//    }

    /**
     * @Route("/{id}/edit", name="location_edit", methods="GET|POST")
     */
    public function edit(Request $request, Location $location): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('location_edit', ['id' => $location->getId()]);
            return $this->redirectToRoute('location_index');
        }

        return $this->render('location/edit.html.twig', [
            'location' => $location,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_delete", methods="DELETE")
     */
    public function delete(Request $request, Location $location): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$location->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('location_index');
        }

        if (!$location->getCelebrations()->isEmpty()) {
            $numOfCelebrations = \count($location->getCelebrations());
            $this->addFlash('danger', '<strong>Error!</strong> Cannot delete ' . $location->getName() . ' because it is being used by ' . $numOfCelebrations . ' Celebration(s)');
            return $this->redirectToRoute('location_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('location_index');
    }
}
