<?php

namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\ProductRepository;
use core\UserRepository;
use models\Product;

class UsersController extends Controller
{

    public function indexAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        $this->render("views/users.php", [
            'users' => UserRepository::getAll()
        ]);
    }

    public function bannedAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        UserRepository::ban($_REQUEST["id"], 1);
        $this->redirect("/users/");
    }

    public function unbannedAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        UserRepository::ban($_REQUEST["id"], 0);
        $this->redirect("/users/");
    }
}
