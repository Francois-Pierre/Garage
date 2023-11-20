<?php

namespace App\Controller;

use App\Entity\Letter;
use App\Form\LetterType;
use App\Repository\LetterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/letter')]
class LetterController extends AbstractController
{
    #[Route('/', name: 'app_letter_index', methods: ['GET'])]
    public function index(LetterRepository $letterRepository): Response
    {
        return $this->render('letter/index.html.twig', [
            'letters' => $letterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_letter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $letter = new Letter();

        //Récupération du title depuis l'annonce
        $title = $request->query->get('title');
        $additionalText = 'Au sujet de l\'annonce :' ;
        if ($title) {
            $titleWithText = $additionalText . $title;
            $letter->setText($titleWithText);
        }

        $form = $this->createForm(LetterType::class, $letter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($letter);
            $entityManager->flush();

            return $this->redirectToRoute('app_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('letter/new.html.twig', [
            'letter' => $letter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_letter_show', methods: ['GET'])]
    public function show(Letter $letter): Response
    {
        return $this->render('letter/show.html.twig', [
            'letter' => $letter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_letter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Letter $letter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LetterType::class, $letter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('letter/edit.html.twig', [
            'letter' => $letter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_letter_delete', methods: ['POST'])]
    public function delete(Request $request, Letter $letter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$letter->getId(), $request->request->get('_token'))) {
            $entityManager->remove($letter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_letter_index', [], Response::HTTP_SEE_OTHER);
    }
}
