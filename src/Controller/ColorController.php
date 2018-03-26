<?php

namespace App\Controller;

use App\Entity\Color;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/color")
 */
class ColorController extends Controller
{
    /**
     * @Route("/", name="color_index", methods="GET")
     */
    public function index(): Response
    {
        $colors = $this->getDoctrine()
            ->getRepository(Color::class)
            ->findAll();

        return $this->render('color/index.html.twig', ['colors' => $colors]);
    }

    /**
     * @Route("/new", name="color_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $color = new Color();
        $form = $this->createForm(DropdownType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('color_index');
        }

        return $this->render('color/new.html.twig', [
            'color' => $color,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="color_show", methods="GET")
//     */
//    public function show(Color $color): Response
//    {
//        return $this->render('color/show.html.twig', ['color' => $color]);
//    }

    /**
     * @Route("/{id}/edit", name="color_edit", methods="GET|POST")
     */
    public function edit(Request $request, Color $color): Response
    {
        $form = $this->createForm(DropdownType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('color_edit', ['id' => $color->getId()]);
        }

        return $this->render('color/edit.html.twig', [
            'color' => $color,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="color_delete", methods="DELETE")
     */
    public function delete(Request $request, Color $color): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$color->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('color_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($color);
        $em->flush();

        return $this->redirectToRoute('color_index');
    }
}
