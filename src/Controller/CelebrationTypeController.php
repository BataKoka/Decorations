<?php

namespace App\Controller;

use App\Entity\CelebrationType;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/celebration/type")
 */
class CelebrationTypeController extends Controller
{
    /**
     * @Route("/", name="celebration_type_index", methods="GET")
     */
    public function index(): Response
    {
        $celebrationTypes = $this->getDoctrine()
            ->getRepository(CelebrationType::class)
            ->findAll();

        return $this->render('celebration_type/index.html.twig', ['celebration_types' => $celebrationTypes]);
    }

    /**
     * @Route("/new", name="celebration_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $celebrationType = new CelebrationType();
        $form = $this->createForm(DropdownType::class, $celebrationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($celebrationType);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('celebration_type_index');
        }

        return $this->render('celebration_type/new.html.twig', [
            'celebration_type' => $celebrationType,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="celebration_type_show", methods="GET")
//     */
//    public function show(CelebrationType $celebrationType): Response
//    {
//        return $this->render('celebration_type/show.html.twig', ['celebration_type' => $celebrationType]);
//    }

    /**
     * @Route("/{id}/edit", name="celebration_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, CelebrationType $celebrationType): Response
    {
        $form = $this->createForm(DropdownType::class, $celebrationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('celebration_type_edit', ['id' => $celebrationType->getId()]);
            return $this->redirectToRoute('celebration_type_index');
        }

        return $this->render('celebration_type/edit.html.twig', [
            'celebration_type' => $celebrationType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="celebration_type_delete", methods="DELETE")
     */
    public function delete(Request $request, CelebrationType $celebrationType): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$celebrationType->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('celebration_type_index');
        }

        if (!$celebrationType->getCelebrations()->isEmpty()) {
            $numOfCelebrations = \count($celebrationType->getCelebrations());
            $this->addFlash('danger', '<strong>Error!</strong> Cannot delete ' . $celebrationType->getName() . ' because it is being used by ' . $numOfCelebrations . ' Celebration(s)');
            return $this->redirectToRoute('celebration_type_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($celebrationType);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('celebration_type_index');
    }
}
