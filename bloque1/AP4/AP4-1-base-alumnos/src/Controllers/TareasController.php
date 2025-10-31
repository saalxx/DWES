<?php

namespace AP41\Controllers;

use AP41\Core\EntityManager;
use AP41\Views\DetalleTarea;
use AP41\Entity\Task;
use AP41\Views\ListadoTareas;

/**
 * Controlador para la ruta /detalle
 */
class TareasController
{

    public function list()
    {
    $entityManager = new EntityManager();
    $taskRespository = $entityManager->getEntityManager()->getRepository(task::class);
    $tareas = $taskRespository->findAll();
    $view = new DetalleTarea();
    $view->render($tareas);
    }

    public function detail($id = null)
    {
        $entityManager = new EntityManager();
        $taskRespository = $entityManager->getEntityManager()->getRepository(task::class);
        $tareas = $taskRespository->find($id);
        $view = new DetalleTarea();
        $view->render($tareas);
    }
}