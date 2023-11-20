<?php

namespace App\Controller;

use App\Repository\CardRepository;
use App\Repository\OpeningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalesController extends AbstractController
{
    #[Route('/sales', name: 'app_sales')]
    public function index(CardRepository $CardRepository, OpeningRepository $openingRepository): Response
    {
        $cards = $CardRepository->findAll();

        $opening = $openingRepository->find(1);


        return $this->render('sales/index.html.twig', [
            'controller_name' => 'SalesController',
            'cards' => $cards,
            'opening' => $opening,
        ]);
    }
}
