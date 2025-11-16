<?php

namespace AP52\Controllers;

use AP52\Core\EntityManager;
use AP52\Entity\User;
use AP52\Repository\UserRepository;
use AP52\Views\FormUpdateUser;
use AP52\Views\ListUserView;
use AP52\Views\DetailUserView;
use AP52\Views\FormUser\View;


class UserController
{

    private EntityManager $entityManager;
    private UserRepository $repository;

    public function __construct()
    {
        $this->entityManager = new EntityManager();
        $this->repository = $this->entityManager->getEntityManager()->getRepository(User::class);
    }


    public function list(): void
    {
        $users = $this->repository->findAll();
        $view = new ListUserView();
        $view->render($users);
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
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setFirstSubname($_POST['firstSubname']);
            $user->setCountry($_POST['country']);
            $user->setEmail($_POST['email']);
            $user->setName($_POST['name']);
            $em = $this->entityManager->getEntityManager();
            $em->persist($user);
            $em->flush();

            $this->list();
        } else {
            $view = new FormUpdateUser();
            $view->render(false, null);
        }
    }


    private function update(?string $id): void
    {
        $userId = intval($id);
        $user = $this->repository->find($userId);

        if (!$user) {
            $this->noRuta();
            return;
        }

        if (isset($_POST['submit'])) {
            if (!isset($_POST['username']) || !isset($_POST['firstSubname']) ||
                !isset($_POST['country']) || !isset($_POST['email']) || !isset($_POST['name']))
                 {
                $this->noRuta();
                return;
            }

            $user = $this->repository->find($userId);
            $user->setUsername($_POST['username']);
            $user->setFirstSubname($_POST['firstSubname']);
            $user->setCountry($_POST['country']);
            $user->setEmail($_POST['email']);
            $user->setName($_POST['name']);
            $em = $this->entityManager->getEntityManager();
            $em->flush();
            $this->list();
        } else {
            $view = new FormUpdateUser();
            $view->render(true, $user);
        }
    }

    private function delete(?string $id): void
    {
        $userId = intval($id);
        $user = $this->repository->find($userId);

        if (!$user) {
            $this->noRuta();
            return;
        }

        $em = $this->entityManager->getEntityManager();
        $em->remove($user);
        $em->flush();

        $this->list();
    }


    private function read(?string $id): void
    {
        $userId = intval($id);
        $user = $this->repository->find($userId);

        if (!$user) {
            $this->noRuta();
            return;
        }

        $view = new DetailUserView();
        $view->render($user);
    }

    private function noRuta()
    {
        (new MainController)->noRuta();
    }
}