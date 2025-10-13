<?php
require_once __DIR__ . "/../src/controllers/TareasController.php";
require_once __DIR__ . "/../src/models/Tarea.php";
require_once __DIR__ . "/../src/views/ListadoTareas.php";

$controller = new TareasController();
$controller->index();