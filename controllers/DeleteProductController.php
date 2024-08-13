<?php

namespace controllers;

use core\Controller;
use core\ProductRepository;


class DeleteProductController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $product = ProductRepository::getById($_REQUEST["id"]);
        ProductRepository::reduceQuantity($_REQUEST["id"], $product->quantity);

        $this->render("index.php");

    }
}
