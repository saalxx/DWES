<?php

namespace AP41\Views;

use AP41\Entity\Task;

class DetalleTarea
{
    const HTML = __DIR__ . '/../../public/assets/detalle.html';

    /**
     * Renderiza la vista de detalle de tarea.
     * @param Task|null $tarea
     * @return void
     */
    public function render(Task $tarea = null): void
    {
        require_once self::HTML;
    }

}