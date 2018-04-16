<?php

namespace App\Controller;

use App\Entity\Celebration;
use App\Entity\Decoration;
use App\Form\DecorationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DecorationController extends Controller
{
//    /**
//     * @Route("/", name="decoration_index", methods="GET")
//     */
//    public function index(): Response
//    {
//        $decorations = $this->getDoctrine()
//            ->getRepository(Decoration::class)
//            ->findAll();
//
//        return $this->render('decoration/index.html.twig', ['decorations' => $decorations]);
//    }

    /**
     * @Route("/celebrations/{celebrationId}/decorations/new", name="decoration_new", methods="GET|POST")
     */
    public function new(Request $request, $celebrationId): Response
    {
        $decoration = new Decoration();
        $celebration = $this->getDoctrine()
            ->getRepository(Celebration::class)
            ->find($celebrationId);
        $decoration->setCelebration($celebration);

        $form = $this->createForm(DecorationType::class, $decoration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($decoration);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('celebration_edit', ['id' => $celebrationId]);
        }

        return $this->render('decoration/new.html.twig', [
            'decoration' => $decoration,
            'celebrationId' => $celebrationId,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="decoration_show", methods="GET")
//     */
//    public function show(Decoration $decoration): Response
//    {
//        return $this->render('decoration/show.html.twig', ['decoration' => $decoration]);
//    }

    /**
     * @Route("/decoration/{id}/edit", name="decoration_edit", methods="GET|POST")
     */
    public function edit(Request $request, Decoration $decoration): Response
    {
        $form = $this->createForm(DecorationType::class, $decoration);
        $form->handleRequest($request);
        $celebration = $decoration->getCelebration();
        $celebrationId = $celebration->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('decoration_edit', ['id' => $decoration->getId()]);
            return $this->redirectToRoute('celebration_edit', ['id' => $celebrationId]);
        }

        return $this->render('decoration/edit.html.twig', [
            'decoration' => $decoration,
            'form' => $form->createView(),
            'celebrationId' => $celebrationId,
        ]);
    }

    /**
     * @Route("/decoration/{id}", name="decoration_delete", methods="DELETE")
     */
    public function delete(Request $request, Decoration $decoration): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$decoration->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('decoration_index');
        }

        $celebration = $decoration->getCelebration();
        $celebrationId = $celebration->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($decoration);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('celebration_edit', ['id' => $celebrationId]);
    }
}
