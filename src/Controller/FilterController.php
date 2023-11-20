<?php

namespace App\Controller;

use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CardRepository;


class FilterController extends AbstractController
{
    #[Route('/filter', name: 'app_filter')]
    public function filterCards(Request $request, CardRepository $CardRepository) {

        // Récupérez les paramètres de la requête GET envoyés par AJAX
        $priceMin = $request->query->get('priceMin');
        $priceMax = $request->query->get('priceMax');
        $mileage = $request->query->get('mileage');
        $year = $request->query->get('year');

        // Utilisez les paramètres pour filtrer les cartes
        $filteredCards = $CardRepository->findByFilters($priceMin, $priceMax, $mileage, $year);

        // Transformez les entités en tableau pour la réponse JSON
        $filteredCardsArray = [];
        foreach ($filteredCards as $card) {
            $filteredCardsArray[] = [
                'id' => $card->getId(),
                'title' => $card->getTitle(),
                'price' => $card->getPrice(),
                'mileage' => $card->getMileage(),
                'year' => $card->getYear(),
                'imagePath' => $card->getImagePath(),
                'description' => $card->getDescription(),
                // Ajoutez d'autres champs selon vos besoins
            ];
        }

        // Retournez la réponse JSON
        return new JsonResponse($filteredCardsArray);
    }
}