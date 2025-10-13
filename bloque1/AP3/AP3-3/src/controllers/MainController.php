<?php


namespace AP33\Controllers;

use AP33\Models\Tareas;
use AP33\Views\ListadoTareas;

class MainController
{
    private $tareas;
    private $listadoTareas;

    public function __construct()
    {
        $this->tareas = new Tareas();
        $this->listadoTareas = new ListadoTareas();
    }

    public function main()
    {
        $Tareas = $this->tareas->getTareas();
        return $this->listadoTareas->displayTareas($Tareas);
    }
}