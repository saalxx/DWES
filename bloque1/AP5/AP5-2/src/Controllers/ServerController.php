<?php

namespace AP52\Controllers;

use AP52\Core\EntityManager;
use AP52\Entity\Server;
use AP52\Repository\ServerRepository;
use AP52\Views\DetailServerView;
use AP52\Views\FormUpdateServer;
use AP52\Views\ListServerView;

class ServerController
{
    private EntityManager $entityManager;
    private ServerRepository $repository;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
        $this->repository = $this->entityManager->getEntityManager()->getRepository(Server::class);
    }


    public function list(): void
    {
        $servers = $this->repository->findAll();
        $view = new ListServerView();
        $view->render($servers);
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
            $server = new Server();
            $server->setUrl($_POST['url']);
            $server->setFirstSubname($_POST['firstSubname']);
            $server->setCountryServer($_POST['countryServer']);
            $server->setDomain($_POST['domain']);
            $em = $this->entityManager->getEntityManager();
            $em->persist($server);
            $em->flush();

            $this->list();
        } else {
            $view = new FormUpdateServer();
            $view->render(false, null);
        }
    }


    private function update(?string $id): void
    {
        $serverId = intval($id);
        $server = $this->repository->find($serverId);

        if (!$server) {
            $this->noRuta();
            return;
        }

        if (isset($_POST['submit'])) {
            if (!isset($_POST['url']) || !isset($_POST['firstSubname']) ||
                !isset($_POST['countryServer']) || !isset($_POST['domain']))
            {
                $this->noRuta();
                return;
            }

            $server = $this->repository->find($serverId);
            $server->setUrl($_POST['url']);
            $server->setFirstSubname($_POST['firstSubname']);
            $server->setCountryServer($_POST['countryServer']);
            $server->setDomain($_POST['domain']);
            $em = $this->entityManager->getEntityManager();
            $em->flush();
            $this->list();
        } else {
            $view = new FormUpdateServer();
            $view->render(true, $server);
        }
    }

    private function delete(?string $id): void
    {
        $serverId = intval($id);
        $server = $this->repository->find($serverId);

        if (!$server) {
            $this->noRuta();
            return;
        }

        $em = $this->entityManager->getEntityManager();
        $em->remove($server);
        $em->flush();

        $this->list();
    }


    private function read(?string $id): void
    {
        $serverId = intval($id);
        $server= $this->repository->find($serverId);

        if (!$server) {
            $this->noRuta();
            return;
        }

        $view = new DetailServerView();
        $view->render($server);
    }

    private function noRuta()
    {
        (new MainController)->noRuta();
    }
}