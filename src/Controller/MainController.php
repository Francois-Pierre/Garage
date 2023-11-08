<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CommentRepository $CommentRepository): Response
    {
        $comments = $CommentRepository->findLatestComments(3);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'comments' => $comments,
        ]);
    }
}
