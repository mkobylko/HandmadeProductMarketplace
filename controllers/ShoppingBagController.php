<?php

namespace controllers;

use core\Controller;
use core\ProductRepository;
use models\Product;
use models\ShoppingBag;
use core\ShoppingBagRepository;

class ShoppingBagController extends Controller
{
    public function indexAction()
    {
        if($_COOKIE['user'] === null){
            http_response_code(500);
            echo "Ви не зареєстровані - зареєструйтеся, будь ласка";
            die();
        }

        $user = $this->getUser();

        $shoppingBag = ShoppingBagRepository::getShoppingBagByUser($user->idUser);

        $params = compact("user", "shoppingBag");
        $this->render("views/ShoppingBag.php", $params);



    }

    public function addAction()
    {

        $productId = $_REQUEST["productId"];
        $user = $this->getUser();

        $quantity = $_REQUEST["quantity"];
        $price = $_REQUEST["price"];

        $idShoppingBag = $_REQUEST['idShoppingBag'];

        if($_COOKIE['user'] === null){
            http_response_code(500);
            echo "Ви не зареєстровані - зареєструйтеся, будь ласка";
            die();
        }

        $shoppingBag = new ShoppingBag($idShoppingBag, $productId, $user->idUser, $quantity, $price * $quantity, null);

        //add to db
        ShoppingBagRepository::add($shoppingBag);

        $count = ShoppingBagRepository::getCountByUser($user->idUser);

        echo $count;

    }

    public function removeAction()
    {
        if($_COOKIE['user'] === null){
            http_response_code(500);
            echo "Ви не зареєстровані - зареєструйтеся, буудь ласка";
            die();
        }


        $productId = $_REQUEST["productId"];
        $user = $this->getUser();

        if($_COOKIE['user'] === null){
            http_response_code(500);
            echo "Ви не зареєстровані - зареєструйтеся, будь ласка";
            die();
        }
        ShoppingBagRepository::deleteShoppingBag($productId, $user->idUser);
        $this->redirect("/shoppingBag/");


    }

    public function clearAction()
    {
        unset($_SESSION['shoppingBag']);
    }

}