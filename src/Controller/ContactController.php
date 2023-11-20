<?php

namespace App\Controller;

use App\Repository\OpeningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(OpeningRepository $openingRepository): Response
    {
        $opening = $openingRepository->find(1);

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'opening' => $opening,
        ]);
    }
}
