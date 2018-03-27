<?php

namespace App\Controller;

use App\Entity\PrintType;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/print/type")
 */
class PrintTypeController extends Controller
{
    /**
     * @Route("/", name="print_type_index", methods="GET")
     */
    public function index(): Response
    {
        $printTypes = $this->getDoctrine()
            ->getRepository(PrintType::class)
            ->findAll();

        return $this->render('print_type/index.html.twig', ['print_types' => $printTypes]);
    }

    /**
     * @Route("/new", name="print_type_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $printType = new PrintType();
        $form = $this->createForm(DropdownType::class, $printType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($printType);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('print_type_index');
        }

        return $this->render('print_type/new.html.twig', [
            'print_type' => $printType,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="print_type_show", methods="GET")
//     */
//    public function show(PrintType $printType): Response
//    {
//        return $this->render('print_type/show.html.twig', ['print_type' => $printType]);
//    }

    /**
     * @Route("/{id}/edit", name="print_type_edit", methods="GET|POST")
     */
    public function edit(Request $request, PrintType $printType): Response
    {
        $form = $this->createForm(DropdownType::class, $printType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('print_type_edit', ['id' => $printType->getId()]);
            return $this->redirectToRoute('print_type_index');
        }

        return $this->render('print_type/edit.html.twig', [
            'print_type' => $printType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="print_type_delete", methods="DELETE")
     */
    public function delete(Request $request, PrintType $printType): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$printType->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('print_type_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($printType);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('print_type_index');
    }
}
