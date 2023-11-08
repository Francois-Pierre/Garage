<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function newComment(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement dans la bdd
            $entityManager->persist($comment);
            $entityManager->flush();

            //Redirection de l'utilisateur
            return $this->redirectToRoute('app_main');
        }

        return $this->render('comment/index.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }
    #[Route('/comment/{id}', name: 'app_comment_show')]
    public function showComment(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }
}
