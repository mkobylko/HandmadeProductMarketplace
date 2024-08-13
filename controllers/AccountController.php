<?php

namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\Template;
use core\UserRepository;
use models\User;


class AccountController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $this->render("views/account.php", [
            'user' => $this->getUser()
        ]);
    }

    public function updateAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $user = $this->getUser();


        $user->login = $_REQUEST['login'];
        $user->email = $_REQUEST['email'];
        $user->fullName = $_REQUEST['fullName'];


        if ($user === null) {
            http_response_code(500);
            echo "Ви не мате права на дану дію";
            die();
        }
        if ($user->login === null || strlen($user->login) < 3) {
            http_response_code(500);
            echo "Логін повинен містити принаймні 3 символи";
            die();
        }
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(500);
            echo "Пошта введена некоректно";
            die();
        }
        if ($user->fullName === null || strlen($user->fullName) < 4) {
            http_response_code(500);
            echo "Ім'я повинно містити принаймні 4 символи";
            die();
        }
        $user = UserRepository::updateUser($user);

        setcookie('user', $user->login . " " . $user->password, -1, '/');
        echo json_encode($user);
    }
}