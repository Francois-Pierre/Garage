<?php

namespace App\Controller;

use App\Repository\OpeningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/legal', name: 'app_legal')]
    public function index(OpeningRepository $openingRepository): Response
    {
        $opening = $openingRepository->find(1);

        return $this->render('legal/index.html.twig', [
            'controller_name' => 'LegalController',
            'opening' => $opening,
        ]);
    }
}
