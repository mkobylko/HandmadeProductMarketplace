<?php

namespace controllers;


use core\ProductRepository;
use core\Controller;
use core\UserRepository;

class ProductController extends Controller
{
    public function indexAction()
    {

        $product = ProductRepository::getById($_REQUEST["id"]);
        $seller = UserRepository::getById($product->idUser);
        $user = $this->getUser();

        $params = compact("product", "seller", "user");

        $this->render("views/product.php", $params);

    }
}