<?php

namespace AP42\Views;

use AP42\Entity\User;

class DetalleUser
{
    const HTML = __DIR__ . '/../../public/assets/detalle.html';

    /**
     * Renderiza la vista de detalle de tarea.
     * @param User|null $user
     * @return void
     */
    public function render(User $user = null): void
    {
        require_once self::HTML;
    }

}