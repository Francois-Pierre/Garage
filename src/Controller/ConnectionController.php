<?php

namespace App\Controller;

use Exception;
use App\Repository\OpeningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectionController extends AbstractController
{
    #[Route('/connection', name: 'app_connection')]
    public function connexion(AuthenticationUtils $authenticationUtils, OpeningRepository $openingRepository): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $opening = $openingRepository->find(1);

        return $this->render('connection/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'opening' => $opening,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
        throw new Exception('Erreur détectée');
    }
}
