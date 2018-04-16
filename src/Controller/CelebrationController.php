<?php

namespace App\Controller;

use App\Entity\Celebration;
use App\Entity\Decoration;
use App\Form\CelebrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form;

/**
 * @Route("/celebration")
 */
class CelebrationController extends Controller
{
    /**
     * @Route("/", name="celebration_index", methods="GET")
     */
    public function index(): Response
    {
        $celebrations = $this->getDoctrine()
            ->getRepository(Celebration::class)
            ->findAll();

        return $this->render('celebration/index.html.twig', ['celebrations' => $celebrations]);
    }

    /**
     * @Route("/new", name="celebration_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $celebration = new Celebration();
        $form = $this->createForm(CelebrationType::class, $celebration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($celebration);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            if ($request->request->has('saveAndContinue')) {
                return $this->redirectToRoute('celebration_edit', ['id' => $celebration->getId()]);
            }

            return $this->redirectToRoute('celebration_index');
        }

        return $this->render('celebration/new.html.twig', [
            'celebration' => $celebration,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="celebration_show", methods="GET")
//     */
//    public function show(Celebration $celebration): Response
//    {
//        return $this->render('celebration/show.html.twig', ['celebration' => $celebration]);
//    }

    /**
     * @Route("/{id}/edit", name="celebration_edit", methods="GET|POST")
     */
    public function edit(Request $request, Celebration $celebration): Response
    {
        $form = $this->createForm(CelebrationType::class, $celebration);
        $form->handleRequest($request);

        $decorations = $this->getDoctrine()
            ->getRepository(Decoration::class)
            ->findBy(['celebration' => $celebration->getId()]);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

            if ($request->request->has('saveAndContinue')) {
                return $this->redirectToRoute('celebration_edit', ['id' => $celebration->getId()]);
            }

//            return $this->redirectToRoute('celebration_edit', ['id' => $celebration->getId()]);
            return $this->redirectToRoute('celebration_index');
        }

        return $this->render('celebration/edit.html.twig', [
            'celebration' => $celebration,
            'form' => $form->createView(),
            'decorations' => $decorations,
        ]);
    }

    /**
     * @Route("/{id}", name="celebration_delete", methods="DELETE")
     */
    public function delete(Request $request, Celebration $celebration): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$celebration->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('celebration_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($celebration);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('celebration_index');
    }
}
