<?php

namespace App\Controller;

use App\Entity\PlayerCard;
use App\Form\PlayerCardType;
use App\Repository\PlayerCardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/player/card')]
final class PlayerCardController extends AbstractController
{
    #[Route(name: 'app_player_card_index', methods: ['GET'])]
    public function index(PlayerCardRepository $playerCardRepository): Response
    {
        return $this->render('player_card/index.html.twig', [
            'player_cards' => $playerCardRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_player_card_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playerCard = new PlayerCard();
        $form = $this->createForm(PlayerCardType::class, $playerCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playerCard);
            $entityManager->flush();

            return $this->redirectToRoute('app_player_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('player_card/new.html.twig', [
            'player_card' => $playerCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_player_card_show', methods: ['GET'])]
    public function show(PlayerCard $playerCard): Response
    {
        return $this->render('player_card/show.html.twig', [
            'player_card' => $playerCard,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_player_card_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlayerCard $playerCard, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlayerCardType::class, $playerCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_player_card_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('player_card/edit.html.twig', [
            'player_card' => $playerCard,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_player_card_delete', methods: ['POST'])]
    public function delete(Request $request, PlayerCard $playerCard, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playerCard->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($playerCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_player_card_index', [], Response::HTTP_SEE_OTHER);
    }
}
