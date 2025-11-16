<?php

namespace AP52\Views;

class FormUpdateUser
{
    public function render($update = false, $user = null)
    {
        $template = __DIR__ . "/../../public/assets/formUser.html";
        include_once $template;
    }
}
