<?php

namespace App\Controller;

use App\Entity\Concurrence;
use App\Form\ConcurrenceType;
use App\Repository\ConcurrenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/concurrence")
 */
class ConcurrenceController extends AbstractController
{
    /**
     * @Route("/", name="concurrence_index", methods={"GET"})
     */
    public function index(ConcurrenceRepository $concurrenceRepository): Response
    {
        return $this->render('concurrence/index.html.twig', [
            'concurrences' => $concurrenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="concurrence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $concurrence = new Concurrence();
        $form = $this->createForm(ConcurrenceType::class, $concurrence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concurrence);
            $entityManager->flush();

            return $this->redirectToRoute('concurrence_index');
        }

        return $this->render('concurrence/new.html.twig', [
            'concurrence' => $concurrence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="concurrence_show", methods={"GET"})
     */
    public function show(Concurrence $concurrence): Response
    {
        return $this->render('concurrence/show.html.twig', [
            'concurrence' => $concurrence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="concurrence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Concurrence $concurrence): Response
    {
        $form = $this->createForm(ConcurrenceType::class, $concurrence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concurrence_index');
        }

        return $this->render('concurrence/edit.html.twig', [
            'concurrence' => $concurrence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="concurrence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Concurrence $concurrence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concurrence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($concurrence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('concurrence_index');
    }
}
