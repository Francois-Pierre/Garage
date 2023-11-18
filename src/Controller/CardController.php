<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CardController extends AbstractController
{
    #[Route('/card', name: 'app_card')]
    public function newCard(Request $request, EntityManagerInterface $entityManager): Response
    {
        $card = new Card();
        $form = $this->createForm(CardFormType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //upload de l'image
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();

                //deplace l'image vers le dossier
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // a mettre a jour
                }

                //Mise à jour de l'url de l'image dans card
                $card->setImagePath($newFilename);
            }

            // Enregistrement dans la bdd
            $entityManager->persist($card);
            $entityManager->flush();

            //Redirection de l'utilisateur
            return $this->redirectToRoute('app_sales');
        }

        return $this->render('card/index.html.twig', [
            'cardForm' => $form->createView(),
        ]);
    }
}
