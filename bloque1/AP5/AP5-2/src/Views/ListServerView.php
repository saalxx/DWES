<?php

namespace AP52\Views;

class ListServerView
{
    public function render(array $servers)
    {
        $template = __DIR__ . "/../../public/assets/listServer.html";
        include_once $template;
    }
}