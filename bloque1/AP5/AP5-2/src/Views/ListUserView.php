<?php

namespace AP52\Views;

class ListUserView
{
    public function render(array $users)
    {
        $template = __DIR__ . "/../../public/assets/listUser.html";
        include_once $template;
    }
}
