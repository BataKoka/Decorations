<?php

namespace App\Controller;

use App\Entity\Shape;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shape")
 */
class ShapeController extends Controller
{
    /**
     * @Route("/", name="shape_index", methods="GET")
     */
    public function index(): Response
    {
        $shapes = $this->getDoctrine()
            ->getRepository(Shape::class)
            ->findAll();

        return $this->render('shape/index.html.twig', ['shapes' => $shapes]);
    }

    /**
     * @Route("/new", name="shape_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $shape = new Shape();
        $form = $this->createForm(DropdownType::class, $shape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shape);
            $em->flush();

            return $this->redirectToRoute('shape_index');
        }

        return $this->render('shape/new.html.twig', [
            'shape' => $shape,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="shape_show", methods="GET")
//     */
//    public function show(Shape $shape): Response
//    {
//        return $this->render('shape/show.html.twig', ['shape' => $shape]);
//    }

    /**
     * @Route("/{id}/edit", name="shape_edit", methods="GET|POST")
     */
    public function edit(Request $request, Shape $shape): Response
    {
        $form = $this->createForm(DropdownType::class, $shape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shape_edit', ['id' => $shape->getId()]);
        }

        return $this->render('shape/edit.html.twig', [
            'shape' => $shape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shape_delete", methods="DELETE")
     */
    public function delete(Request $request, Shape $shape): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$shape->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('shape_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($shape);
        $em->flush();

        return $this->redirectToRoute('shape_index');
    }
}
