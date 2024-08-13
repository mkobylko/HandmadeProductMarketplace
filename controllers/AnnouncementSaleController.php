<?php

namespace controllers;

use core\ProductRepository;
use core\UserRepository;
use core\Controller;


class AnnouncementSaleController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $user = $this->getUser();

        $products = ProductRepository::getByUser($user->idUser);

        $announcementNotActive = 0;
        foreach ($products as $product) {
            if ($product->quantity == 0) {
                $announcementNotActive = 1;
            }
        }

        $params = compact("user", "products", "announcementNotActive");
        $this->render("views/announcementSale.php", $params);

    }

    public function reduceAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $product = ProductRepository::getById($_REQUEST["id"]);
        $user = $this->getUser();
        if ($product->idUser != $user->idUser && !$user->isAdmin()) {
            http_response_code(403);
            return;
        }

        ProductRepository::reduceQuantity($_REQUEST["id"], $product->quantity);

        $this->redirect("/announcementSale/");
    }

}