<?php

namespace App\Controller;

use App\Entity\PlayerCard;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiPlayerCardController extends AbstractController
{
    #[Route('/api/players', methods: ['GET'], name: 'list')]
    public function list(EntityManagerInterface $em): JsonResponse
    {
        $player = $em->getRepository(PlayerCard::class)->findAll();
        $data = [];

        foreach ($player as $card) {
            $data[] = [
                'id' => $card->getId(),
                'name' => $card->getName(),
                'surname' => $card->getSurname(),
                'age' => $card->getAge(),
                'team' => $card->getCurrentTeam(),
                'goal' => $card->getGoalsScored(),
                'card' => $card->getCardsReceived(),
                'birthday' => $card->getBirthDate(),
            ];
        }
        return new JsonResponse($data);
    }
    #[Route('/api/players/{id}', methods: ['GET'], name: 'show')]
    public function show(PlayerCard $player): JsonResponse
    {
        $data = [
            'id' => $player->getId(),
            'name' => $player->getName(),
            'surname' => $player->getSurname(),
            'age' => $player->getAge(),
            'currentTeam' => $player->getCurrentTeam(),
            'goal' => $player->getGoalsScored(),
            'cardsReceived' => $player->getCardsReceived(),
            'birthDate' => $player->getBirthDate(),
        ];

        return new JsonResponse($data);
    }
    #[Route('/api/players', methods: ['POST'], name: 'create')]
    public function create(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $player = new PlayerCard();
        $player->setName($data['name']);
        $player->setSurname($data['surname']);
        $player->setAge($data['age']);
        $player->setCurrentTeam($data['currentTeam']);
        $player->setGoalsScored($data['goal']);
        $player->setCardsReceived($data['cardsReceived']);
        $player->setBirthDate(new DateTimeImmutable($data['birthDate']));

        $em->persist($player);
        $em->flush();
        /* PARA CASOS DE PRUEBA

        "birthDate": "2026-01-22 17:32:00"

        */
        return new JsonResponse(['status' => 'ok'], 201);
    }
    #[Route('/api/players/{id}', methods: ['PUT', 'PATCH'], name: 'update')]
    public function update(EntityManagerInterface $em, Request $request, PlayerCard $player): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(isset($data['name'])) {
            $player->setName($data['name']);
        }
        if(isset($data['surname'])) {
            $player->setSurname($data['surname']);
        }
        if(isset($data['age'])) {
            $player->setAge($data['age']);
        }
        if(isset($data['currentTeam'])) {
            $player->setCurrentTeam($data['currentTeam']);
        }
        if(isset($data['goal'])) {
            $player->setGoalsScored($data['goal']);
        }
        if(isset($data['cardsReceived'])) {
            $player->setCardsReceived($data['cardsReceived']);
        }
        if(isset($data['birthDate'])) {
            $player->setBirthDate(new DateTimeImmutable($data['birthDate']));
        }

        $em->persist($player);
        $em->flush();
        /* PARA CASOS DE PRUEBA

        "birthDate": "2026-01-22 17:32:00"

        */
        return new JsonResponse(['status' => 'ok'], 201);
    }
    #[Route('/api/players/{id}', methods: ['DELETE'], name: 'delete')]
    public function delete(EntityManagerInterface $em, PlayerCard $player): JsonResponse
    {

        $em->remove($player);
        $em->flush();

        return new JsonResponse(['status' => 'ok'], 201);
    }
}
