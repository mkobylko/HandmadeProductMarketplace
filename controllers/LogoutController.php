<?php

namespace controllers;

use core\Controller;


class LogoutController extends Controller
{
    public function indexAction()
    {


        unset($_COOKIE["user"]);
        setcookie("user", null, -1, '/');
        session_destroy();

        $this->redirect("/" );

    }
}