<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalesController extends AbstractController
{
    #[Route('/sales', name: 'app_sales')]
    public function index(CardRepository $CardRepository): Response
    {
        $cards = $CardRepository->findAll();


        return $this->render('sales/index.html.twig', [
            'controller_name' => 'SalesController',
            'cards' => $cards,
        ]);
    }
}
