<?php

namespace App\Controller;

use App\Entity\Diameter;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/diameter")
 */
class DiameterController extends Controller
{
    /**
     * @Route("/", name="diameter_index", methods="GET")
     */
    public function index(): Response
    {
        $diameters = $this->getDoctrine()
            ->getRepository(Diameter::class)
            ->findAll();

        return $this->render('diameter/index.html.twig', ['diameters' => $diameters]);
    }

    /**
     * @Route("/new", name="diameter_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $diameter = new Diameter();
        $form = $this->createForm(DropdownType::class, $diameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diameter);
            $em->flush();

            return $this->redirectToRoute('diameter_index');
        }

        return $this->render('diameter/new.html.twig', [
            'diameter' => $diameter,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="diameter_show", methods="GET")
//     */
//    public function show(Diameter $diameter): Response
//    {
//        return $this->render('diameter/show.html.twig', ['diameter' => $diameter]);
//    }

    /**
     * @Route("/{id}/edit", name="diameter_edit", methods="GET|POST")
     */
    public function edit(Request $request, Diameter $diameter): Response
    {
        $form = $this->createForm(DropdownType::class, $diameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diameter_edit', ['id' => $diameter->getId()]);
        }

        return $this->render('diameter/edit.html.twig', [
            'diameter' => $diameter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="diameter_delete", methods="DELETE")
     */
    public function delete(Request $request, Diameter $diameter): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$diameter->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('diameter_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($diameter);
        $em->flush();

        return $this->redirectToRoute('diameter_index');
    }
}
