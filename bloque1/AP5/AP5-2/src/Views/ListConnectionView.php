<?php

namespace AP52\Views;

class ListConnectionView
{
    public function render(array $connections)
    {
        $template = __DIR__ . "/../../public/assets/listConnection.html";
        include_once $template;
    }
}