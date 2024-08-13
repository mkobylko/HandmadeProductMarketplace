<?php

namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\ProductRepository;
use core\UserRepository;
use models\Product;

class SellController extends Controller
{

    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }
        $this->render("views/sell.php", [
            'categories' => CategoryRepository::getAll()
        ]);

    }

    public function addAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $product = $this->createProduct("/sell?");

        ProductRepository::add($product);
        $this->redirect("/");
    }

    public function updateAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $idProduct = $_REQUEST['idProduct'];
        $product = $this->createProduct("/sell/updateProduct?id=$idProduct&");

        ProductRepository::updateProduct($product);

        $this->redirect("/announcementSale/");
    }

    public function updateProductAction()
    {
        $product = ProductRepository::getById($_REQUEST["id"]);

        $this->render("views/updateProduct.php", [
            'product' => $product,
            'categories' => CategoryRepository::getAll()
        ]);
    }

    function createProduct($action)
    {
        $name = $_REQUEST['product_name'];
        $dimension = $_REQUEST['dimension'];
        $price = $_REQUEST['price'];
        $description = $_REQUEST['description'];
        $category = $_REQUEST['category'];

        $quantity = $_REQUEST['quantity'];
        $idProduct = $_REQUEST['idProduct'];

        $imgContent = $_REQUEST['photo'];

        $user = $this->getUser();

        if (!empty($_FILES["photo"]["name"])) {
            $fileName = basename($_FILES["photo"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES['photo']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
            }
        }


        $product = new Product($idProduct, $name, $dimension, $price, null, $description, $imgContent, $quantity, $category, $user->idUser);

        if ($product->idUser != $user->idUser) {
            $this->redirect($action . "error=7");
        }
        if ($product->name === null || mb_strlen($product->name) < 3) {
            $this->redirect($action . "error=1");
        }
        echo strlen($product->name);
        if ($product->dimension === null || !(preg_match("/(\d+(\.\d+|)\s?x\s?\d+(\.\d+|)(\s?x\s?\d*(\.?\d+|))?)/", $product->dimension))) {
            $this->redirect($action . "error=2");
        }
        if ($product->price === null || !(preg_match("/^\d+(,\d{3})*(\.\d{1,2})?$/", $product->price))) {
            $this->redirect($action . "error=3");
        }
        if ($product->quantity === null || !preg_match('/^[0-9]+$/', $product->quantity)) {
            $this->redirect($action . "error=4");
        }
        if ($product->description === null || strlen($product->description) < 3) {
            $this->redirect($action . "error=5");
        }

        return $product;
    }

}
