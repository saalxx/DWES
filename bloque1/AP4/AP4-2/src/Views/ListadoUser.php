<?php

namespace AP42\Views;

class ListadoUser
{
    const HTML = __DIR__ . '/../../public/assets/user.html';

    /**
     * Renderiza la vista de listado de tareas.
     * @param array|null $user
     * @return void
     */
    public function render(array $user = null): void
    {
        require_once self::HTML;
    }

}