<?php

namespace AP52\Controllers;

use AP52\Core\EntityManager;
use AP52\Entity\Connection;
use AP52\Repository\ConnectionsRepository;
use AP52\Repository\ServerRepository;
use AP52\Views\DetailConnectionView;
use AP52\Views\FormUpdateConnection;
use AP52\Views\ListConnectionView;

class ConnectionController
{
    private EntityManager $entityManager;
    private ConnectionsRepository $repository;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
        $this->repository = $this->entityManager->getEntityManager()->getRepository(Connection::class);
    }


    public function list(): void
    {
        $connections = $this->repository->findAll();
        $view = new ListConnectionView();
        $view->render($connections);
    }


    public function crud(...$params): void
    {
        $action = $params[0] ?? null;
        $id = $params[1] ?? null;

        switch ($action) {
            case 'create':
                $this->create();
                break;
            case 'read':
                $this->read($id);
                break;
            case 'update':
                $this->update($id);
                break;
            case 'delete':
                $this->delete($id);
                break;
            default:
                $this->noRuta();
        }
    }


    private function create(): void
    {
        if (isset($_POST['submit'])) {
            $connection = new Connection();
            $connection->setIp($_POST['ip']);
            $connection->setDateConnection($_POST['dateConnection']);
            $connection->setServer($_POST['server']);
            $connection->setUser($_POST['user']);
            $em = $this->entityManager->getEntityManager();
            $em->persist($connection);
            $em->flush();

            $this->list();
        } else {
            $view = new FormUpdateConnection();
            $view->render(false, null);
        }
    }


    private function update(?string $id): void
    {
        $connectionId = intval($id);
        $connection = $this->repository->find($connectionId);

        if (!$connection) {
            $this->noRuta();
            return;
        }

        if (isset($_POST['submit'])) {
            if (!isset($_POST['ip']) || !isset($_POST['dateConnection']) ||
                !isset($_POST['server']) || !isset($_POST['user']))
            {
                $this->noRuta();
                return;
            }

            $connection = $this->repository->find($connectionId);
            $connection->setIp($_POST['ip']);
            $connection->setDateConnection($_POST['dateConnection']);
            $connection->setServer($_POST['server']);
            $connection->setUser($_POST['user']);
            $em = $this->entityManager->getEntityManager();
            $em->flush();
            $this->list();
        } else {
            $view = new FormUpdateConnection();
            $view->render(true, $connection);
        }
    }

    private function delete(?string $id): void
    {
        $connectionId = intval($id);
        $connection = $this->repository->find($connectionId);

        if (!$connection) {
            $this->noRuta();
            return;
        }

        $em = $this->entityManager->getEntityManager();
        $em->remove($connection);
        $em->flush();

        $this->list();
    }


    private function read(?string $id): void
    {
        $connectionId = intval($id);
        $connection= $this->repository->find($connectionId);

        if (!$connection) {
            $this->noRuta();
            return;
        }

        $view = new DetailConnectionView();
        $view->render($connection);
    }

    private function noRuta()
    {
        (new MainController)->noRuta();
    }
}