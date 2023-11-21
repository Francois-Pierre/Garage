<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class FilterController extends AbstractController
{
    #[Route('/filter', name: 'app_filter')]
    public function filtrage(Request $request, CardRepository $CardRepository): Response
    {
        // Récupère l'année à partir de la requête
        $targetYear = $request->get('year');
    
        // Initialise un tableau vide pour stocker les conditions de filtrage
        $conditions = [];
    
        // Ajoute la condition de filtre si l'année est spécifiée
        if ($targetYear !== null) {
            $conditions['year'] = $targetYear;
        }
    
        // Récupère les cartes en fonction des conditions de filtrage
        $cartesFiltrees = $CardRepository->findBy($conditions);
    
        // Retourne la vue partielle avec les cartes filtrées
        return $this->render('filter/index.html.twig', ['cards' => $cartesFiltrees]);
    }
}