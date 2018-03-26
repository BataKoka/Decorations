<?php

namespace App\Controller;

use App\Entity\ColorType;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/color/type")
 */
class ColorTypeController extends Controller
{
    /**
     * @Route("/", name="color_type_index", methods="GET")
     */
    public function index(): Response
    {
        $colorTypes = $this->getDoctrine()
            ->getRepository(ColorType::class)
            ->findAll();

        return $this->render('color_type/index.html.twig', ['color_types' => $colorTypes]);
    }

    /**
     * @Route("/new", name="color_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $colorType = new ColorType();
        $form = $this->createForm(DropdownType::class, $colorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($colorType);
            $em->flush();

            return $this->redirectToRoute('color_type_index');
        }

        return $this->render('color_type/new.html.twig', [
            'color_type' => $colorType,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="color_type_show", methods="GET")
//     */
//    public function show(ColorType $colorType): Response
//    {
//        return $this->render('color_type/show.html.twig', ['color_type' => $colorType]);
//    }

    /**
     * @Route("/{id}/edit", name="color_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, ColorType $colorType): Response
    {
        $form = $this->createForm(DropdownType::class, $colorType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('color_type_edit', ['id' => $colorType->getId()]);
        }

        return $this->render('color_type/edit.html.twig', [
            'color_type' => $colorType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="color_type_delete", methods="DELETE")
     */
    public function delete(Request $request, ColorType $colorType): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$colorType->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('color_type_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($colorType);
        $em->flush();

        return $this->redirectToRoute('color_type_index');
    }
}
