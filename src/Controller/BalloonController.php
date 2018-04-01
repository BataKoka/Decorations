<?php

namespace App\Controller;

use App\Entity\Balloon;
use App\Form\BalloonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/balloon")
 */
class BalloonController extends Controller
{
    /**
     * @Route("/", name="balloon_index", methods="GET")
     */
    public function index(): Response
    {
        $balloons = $this->getDoctrine()
            ->getRepository(Balloon::class)
            ->findAll();

        return $this->render('balloon/index.html.twig', ['balloons' => $balloons]);
    }

    /**
     * @Route("/new", name="balloon_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $balloon = new Balloon();
        $form = $this->createForm(BalloonType::class, $balloon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($balloon);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('balloon_index');
        }

        return $this->render('balloon/new.html.twig', [
            'balloon' => $balloon,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="balloon_show", methods="GET")
//     */
//    public function show(Balloon $balloon): Response
//    {
//        return $this->render('balloon/show.html.twig', ['balloon' => $balloon]);
//    }

    /**
     * @Route("/{id}/edit", name="balloon_edit", methods="GET|POST")
     */
    public function edit(Request $request, Balloon $balloon): Response
    {
        $form = $this->createForm(BalloonType::class, $balloon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('balloon_edit', ['id' => $balloon->getId()]);
            return $this->redirectToRoute('balloon_index');
        }

        return $this->render('balloon/edit.html.twig', [
            'balloon' => $balloon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="balloon_delete", methods="DELETE")
     */
    public function delete(Request $request, Balloon $balloon): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$balloon->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('balloon_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($balloon);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('balloon_index');
    }
}
