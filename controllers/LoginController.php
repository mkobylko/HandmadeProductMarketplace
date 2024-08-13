<?php

namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\UserRepository;

class LoginController extends Controller
{
    public function indexAction()
    {

        $this->render("views/login.php");
    }

    public function loginAction()
    {
        $login = $_REQUEST['login'];
        $password = bin2hex(md5($_REQUEST['password'], true));

        $cookie = $login . " " . $password;
        $user = UserRepository::getByLogin($cookie);

        if ($_COOKIE['user'] != null) {
            $this->redirect("/login?error=2");
        }
        if ($user === null) {
            $this->redirect("/login?error=1");
        }
        if ($user->banned) {
            $this->redirect("/login?error=3");
        }

        setcookie("user", $cookie, -1, '/');
        $this->redirect("/");
    }
}