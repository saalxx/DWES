<?php

namespace AP52\Views;

class DetailConnectionView
{
    public function render($connection)
    {
        $template = __DIR__ . "/../../public/assets/detailConnection.html";
        include_once $template;
    }
}