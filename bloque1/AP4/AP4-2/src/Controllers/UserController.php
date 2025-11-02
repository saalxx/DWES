<?php

namespace AP42\Controllers;

use AP42\Core\EntityManager;
use AP42\Views\userDetalle;
use AP42\Entity\User;
use AP42\Views\ListadoUser;

/**
 * Controlador para la ruta /detalle
 */
class UserController
{

    public function list()
    {
        $entityManager = new EntityManager();
        $UserRespository = $entityManager->getEntityManager()->getRepository(user::class);
        $user = $UserRespository->findAll();
        $view = new ListadoUser();
        $view->render($user);
    }

    public function detail($id = null)
    {
        $entityManager = new EntityManager();
        $UserRespository = $entityManager->getEntityManager()->getRepository(user::class);
        $user = $UserRespository->find($id);
        $view = new DetalleUser();
        $view->render($user);
    }
}