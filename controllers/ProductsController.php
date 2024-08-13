<?php

namespace controllers;

use core\Controller;
use core\ProductRepository;
use core\UserRepository;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $categoryId = $_REQUEST["category"];
        $priceFrom = $_REQUEST["priceFrom"];
        $priceTo = $_REQUEST["priceTo"];
        $name = $_REQUEST["name"];
        $mark = $_REQUEST["mark"];
        $products = ProductRepository::getByFilter($categoryId, $priceFrom, $priceTo, $name, $mark);
        $user = $this->getUser();

        $params = compact("categoryId", "priceFrom", "priceTo", "name", "mark", "products", "user");
        $this->render("views/products.php", $params);
    }

    public function deleteAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }

        $productId = $_REQUEST["id"];

        $product = ProductRepository::getById($productId);
        ProductRepository::reduceQuantity($productId, $product->quantity);

        $this->redirect("/products?category=$product->idCategory");
    }

}
