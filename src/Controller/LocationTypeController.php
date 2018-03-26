<?php

namespace App\Controller;

use App\Entity\LocationType;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/location/type")
 */
class LocationTypeController extends Controller
{
    /**
     * @Route("/", name="location_type_index", methods="GET")
     */
    public function index(): Response
    {
        $locationTypes = $this->getDoctrine()
            ->getRepository(LocationType::class)
            ->findAll();

        return $this->render('location_type/index.html.twig', ['location_types' => $locationTypes]);
    }

    /**
     * @Route("/new", name="location_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $locationType = new LocationType();
        $form = $this->createForm(DropdownType::class, $locationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locationType);
            $em->flush();

            return $this->redirectToRoute('location_type_index');
        }

        return $this->render('location_type/new.html.twig', [
            'location_type' => $locationType,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="location_type_show", methods="GET")
//     */
//    public function show(LocationType $locationType): Response
//    {
//        return $this->render('location_type/show.html.twig', ['location_type' => $locationType]);
//    }

    /**
     * @Route("/{id}/edit", name="location_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, LocationType $locationType): Response
    {
        $form = $this->createForm(DropdownType::class, $locationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_type_edit', ['id' => $locationType->getId()]);
        }

        return $this->render('location_type/edit.html.twig', [
            'location_type' => $locationType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="location_type_delete", methods="DELETE")
     */
    public function delete(Request $request, LocationType $locationType): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$locationType->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('location_type_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($locationType);
        $em->flush();

        return $this->redirectToRoute('location_type_index');
    }
}
