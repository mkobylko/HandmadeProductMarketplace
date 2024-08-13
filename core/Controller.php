<?php

namespace core;

class Controller
{

    public function render($viewPath, $params = null)
    {
        $content = $this->renderView($viewPath, $params);


        $menu = $this->renderView("views/includes/menu.php", [
            'user' => $this->getUser(),
            'categories' => CategoryRepository::getAll(),
            'shoppingBagCount' => ShoppingBagRepository::getCountByUser($this->getUser()->idUser)
        ]);

        echo $this->renderView("views/includes/layout.php", [
            'content' => $content,
            'menu' => $menu
        ]);
    }

    function renderView($viewPath, $params = null)
    {
        $tpl = new Template($viewPath);
        if (!empty($params)) {
            $tpl->setParams($params);
        }
        return $tpl->getHTML();
    }

    public function redirect($url)
    {
        header("Location: {$url}");
        die();
    }

    public function authenticated($adminOnly = false) {
        $user = $this->getUser();
        if ($user === null) {
            http_response_code(401);
            return false;
        }
        if ($user->banned) {
            http_response_code(402);
            return false;
        }
        if ($adminOnly && !$user->isAdmin()) {
            http_response_code(403);
            return false;
        }
        return true;
    }

    public function getUser() {
        return UserRepository::getByLogin($_COOKIE["user"]);
    }




}