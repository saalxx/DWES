<?php

namespace AP42\Controllers;

use AP42\Core\EntityManager;
use AP42\Views\Detalle;
<<<<<<< HEAD
use AP42\Entity\Operation;
=======
use AP42\Entity\Operations;
>>>>>>> origin/main
use AP42\Entity\Operations;
use AP42\Views\ListadoOperations;

/**
 * Controlador para la ruta /detalle
 */
 class OperartionsController

{

    public function list()
    {
        $entityManager = new EntityManager();
        $OperationsRespository = $entityManager->getEntityManager()->getRepository(operat::class);
        $user = $OperationsRespository->findAll();
        $view = new ListadoOperations();
        $view->render($user);
    }

    public function detail($id = null)
    {
        $entityManager = new EntityManager();
        $OperationsRespository = $entityManager->getEntityManager()->getRepository(user::class);
        $user = $OperationsRespository->find($id);
        $view = new DetalleOperations();
        $view->render($user);
    }
}?php

namespace AP42\Controllers;

class OperartionsController
{

}