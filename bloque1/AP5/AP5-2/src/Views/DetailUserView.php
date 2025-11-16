<?php

namespace AP52\Views;

class DetailUserView
{
    public function render($user)
    {
        $template = __DIR__ . "/../../public/assets/detailUser.html";
        include_once $template;
    }
}
