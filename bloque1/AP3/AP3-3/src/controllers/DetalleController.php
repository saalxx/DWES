<?php

namespace AP33\controllers;

use AP33\Models\Tareas;
use AP33\Views\ListadoTareas;

class DetalleController {
    private $tareas;
    private $listadoTareas;

    public function __construct()
    {
        $this->tareas = new Tareas();
        $this->listadoTareas = new ListadoTareas();
    }

    public function detail($idTarea = null)
    {
        $Tareas = $this->tareas->getTareas($idTarea);
        return $this->listadoTareas->displayTareas($Tareas);
    }
}
