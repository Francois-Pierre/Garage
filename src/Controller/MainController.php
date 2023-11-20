<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\OpeningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CommentRepository $CommentRepository, OpeningRepository $openingRepository): Response
    {
        $comments = $CommentRepository->findLatestComments(3);

        $opening = $openingRepository->find(1);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'comments' => $comments,
            'opening' => $opening,
        ]);
    }
}
