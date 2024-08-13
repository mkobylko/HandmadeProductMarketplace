<?php

namespace controllers;


use core\Controller;
use core\UserRepository;
use models\User;

class RegisterController extends Controller
{
    public function indexAction()
    {
       /* if (User::isUserAuthenticated())
            $this->redirect('/');*/
        $this->render("views/register.php");
    }

    public function registerAction()
    {
        $login = $_REQUEST['user_name'];
        $password = bin2hex(md5($_REQUEST['password'], true));
        $email = $_REQUEST['email'];
        $fullName = $_REQUEST['name'];

        $user = new User(-1, $login, $password, $email, 2, $fullName, 0);

        if ($_COOKIE['user'] != null) {
            $this->redirect("/register?error=8");
        }
        if ($user->login === null || strlen($user->login) < 3 || strpos($user->login, " ")) {
            $this->redirect("/register?error=1");
        }
        if ($user->password === null || strlen($user->password) < 6) {
            $this->redirect("/register?error=2");
        }
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect("/register?error=4");
        }
        if ($user->fullName === null || strlen($user->fullName) < 4) {
            $this->redirect("/register?error=5");
        }
        if (!empty(UserRepository::isExistLogin($user->login))) {
            $this->redirect("/register?error=6");
        }
        if (!empty(UserRepository::isExistEmail($user->email))) {
            $this->redirect("/register?error=7");
        }

        $user = UserRepository::add($user);
        setcookie('user', $user->login . " " . $user->password, -1, '/');

        $this->redirect("/");

    }

// проверить данные из формы
    function validate_form()
    {
        $errors = array();
        // Содержит ли имя , введенное в текстовом поле my_name
        // хотя бы 5 символов?
        if (strlen($_POST['my_name ']) < 5) {
            $errors [] = ' Your name must Ье at least 3 letters long . ';
        }
        // возвратить ( возможно, пустой) массив сообщений об ошибках
        return $errors;

    }
}