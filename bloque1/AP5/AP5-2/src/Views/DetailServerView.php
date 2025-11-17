<?php

namespace AP52\Views;

class DetailServerView
{
    public function render($server)
    {
        $template = __DIR__ . "/../../public/assets/detailServer.html";
        include_once $template;
    }
}