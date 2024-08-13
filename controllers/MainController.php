<?php

namespace controllers;

use core\Controller;
use core\ProductRepository;

class MainController extends Controller
{
    public function indexAction()
    {

        $products = ProductRepository::getByFilter(null, null, null, null, 5);
        $this->render("views/main.php", [
            'products' => array_slice($products, 0, 4)
        ]);

    }

    public function errorAction($code)
    {
        $error = "Помилка";
        switch ($code) {
            case 404:
                $error = "Сторінку не знайдено";
                break;
            case 401:
                $error = "Будь ласка залогіньтесь";
                break;
            case 402:
                $error = "Акаунт деактивовано";
                break;
            case 403:
                $error = "Недостатньо прав";
                break;

        }
        $this->render("views/errorPage.php", ['error' => $error]);
    }
}



