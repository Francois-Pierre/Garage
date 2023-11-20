<?php

namespace App\Controller;

use App\Entity\Opening;
use App\Form\OpeningType;
use App\Repository\OpeningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/opening')]
class OpeningController extends AbstractController
{
    #[Route('/', name: 'app_opening_index', methods: ['GET'])]
    public function index(OpeningRepository $openingRepository): Response
    {
        return $this->render('opening/index.html.twig', [
            'openings' => $openingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_opening_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $opening = new Opening();
        $form = $this->createForm(OpeningType::class, $opening);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($opening);
            $entityManager->flush();

            return $this->redirectToRoute('app_opening_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opening/new.html.twig', [
            'opening' => $opening,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opening_show', methods: ['GET'])]
    public function show(Opening $opening, OpeningRepository $openingRepository): Response
    {
        $opening = $openingRepository->find(1);

        return $this->render('opening/show.html.twig', [
            'opening' => $opening,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_opening_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Opening $opening, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OpeningType::class, $opening);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_opening_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opening/edit.html.twig', [
            'opening' => $opening,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_opening_delete', methods: ['POST'])]
    public function delete(Request $request, Opening $opening, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opening->getId(), $request->request->get('_token'))) {
            $entityManager->remove($opening);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_opening_index', [], Response::HTTP_SEE_OTHER);
    }
}
