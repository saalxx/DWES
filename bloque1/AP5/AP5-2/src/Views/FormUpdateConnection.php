<?php

namespace AP52\Views;

class FormUpdateConnection
{
    public function render($update = false, $connection = null)
    {
        $template = __DIR__ . "/../../public/assets/formConnection.html";
        include_once $template;
    }
}