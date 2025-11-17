<?php

namespace AP52\Views;

class FormUpdateServer
{
    public function render($update = false, $server = null)
    {
        $template = __DIR__ . "/../../public/assets/formServer.html";
        include_once $template;
    }
}