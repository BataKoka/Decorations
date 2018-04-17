<?php

namespace App\Controller;

use App\Entity\Decoration;
use App\Entity\DecorationItem;
use App\Form\DecorationItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DecorationItemController extends Controller
{
//    /**
//     * @Route("/", name="decoration_item_index", methods="GET")
//     */
//    public function index(): Response
//    {
//        $decorationItems = $this->getDoctrine()
//            ->getRepository(DecorationItem::class)
//            ->findAll();
//
//        return $this->render('decoration_item/index.html.twig', ['decoration_items' => $decorationItems]);
//    }

    /**
     * @Route("/decoration/{decorationId}/decoration/item/new", name="decoration_item_new", methods="GET|POST")
     */
    public function new(Request $request, $decorationId): Response
    {
        $decorationItem = new DecorationItem();
        $decoration = $this->getDoctrine()
            ->getRepository(Decoration::class)
            ->find($decorationId);
        $decorationItem->setDecoration($decoration);

        $form = $this->createForm(DecorationItemType::class, $decorationItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($decorationItem);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('decoration_edit', ['id' => $decorationId]);
        }

        return $this->render('decoration_item/new.html.twig', [
            'decoration_item' => $decorationItem,
            'decorationId' => $decorationId,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="decoration_item_show", methods="GET")
//     */
//    public function show(DecorationItem $decorationItem): Response
//    {
//        return $this->render('decoration_item/show.html.twig', ['decoration_item' => $decorationItem]);
//    }

    /**
     * @Route("/decoration/item/{id}/edit", name="decoration_item_edit", methods="GET|POST")
     */
    public function edit(Request $request, DecorationItem $decorationItem): Response
    {
        $form = $this->createForm(DecorationItemType::class, $decorationItem);
        $form->handleRequest($request);
        $decoration = $decorationItem->getDecoration();
        $decorationId = $decoration->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('decoration_item_edit', ['id' => $decorationItem->getId()]);
            return $this->redirectToRoute('decoration_edit', ['id' => $decorationId]);
        }

        return $this->render('decoration_item/edit.html.twig', [
            'decoration_item' => $decorationItem,
            'form' => $form->createView(),
            'decorationId' => $decorationId,
        ]);
    }

    /**
     * @Route("/decoration/item/{id}", name="decoration_item_delete", methods="DELETE")
     */
    public function delete(Request $request, DecorationItem $decorationItem): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$decorationItem->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('decoration_item_index');
        }

        $decoration = $decorationItem->getDecoration();
        $decorationId = $decoration->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($decorationItem);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('decoration_edit', ['id' => $decorationId]);
    }
}
