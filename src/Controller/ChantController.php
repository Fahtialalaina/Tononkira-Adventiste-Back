<?php

namespace App\Controller;

use App\Entity\Chant;
use App\Form\ChantType;
use App\Repository\ChantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chant")
 */
class ChantController extends AbstractController
{
    /**
     * @Route("/", name="chant_index", methods={"GET"})
     */
    public function index(ChantRepository $chantRepository): Response
    {
        return $this->render('chant/index.html.twig', [
            'chants' => $chantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="chant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chant = new Chant();
        $form = $this->createForm(ChantType::class, $chant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chant);
            $entityManager->flush();

            return $this->redirectToRoute('chant_index');
        }

        return $this->render('chant/new.html.twig', [
            'chant' => $chant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chant_show", methods={"GET"})
     */
    public function show(Chant $chant): Response
    {
        return $this->render('chant/show.html.twig', [
            'chant' => $chant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chant $chant): Response
    {
        $form = $this->createForm(ChantType::class, $chant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chant_index');
        }

        return $this->render('chant/edit.html.twig', [
            'chant' => $chant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chant $chant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chant_index');
    }
}
