<?php

namespace controllers;


use core\Controller;
use core\OrderRepository;
use core\ProductRepository;

use models\Order;
use core\ShoppingBagRepository;

class CheckoutController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }
        $user = $this->getUser();

        $shoppingBag = ShoppingBagRepository::getShoppingBagByUser($user->idUser);


        $sum = 0;

        foreach ($shoppingBag as $value) {
            $sum = $sum + $value->sumPrice;
        }

        $this->render("views/checkout.php", [
            'sum' => $sum,
            'shoppingBag' => $shoppingBag
        ]);
        ;
    }

    public function AddOrderAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $user = $this->getUser();

        $shoppingBag = ShoppingBagRepository::getShoppingBagByUser($user->idUser);

        $date = date('Y-m-d', time());

        $city = $_REQUEST['city'];
        $street = $_REQUEST['street'];
        $house = $_REQUEST['house'];
        $apartment = $_REQUEST['apartment'];


        if ($city === null || !(preg_match("/[А-ЯІЇЄ]([а-яіїє']|-[А-ЯІЇЄ])*/", $city))) {
            $this->redirect("/checkout?error=1");
        }
        if ($street === null || !(preg_match("/[А-ЯІЇЄ]([а-яіїє']|-[А-ЯІЇЄ])*/", $street))) {
            $this->redirect("/checkout?error=2");
        }
        if ($house === null || !(preg_match("/^[0-9]+$/", $house))) {
            $this->redirect("/checkout?error=3");
        }
        if ($apartment === null || !(preg_match("/^[0-9]+$/", $apartment))) {
            $this->redirect("/checkout?error=4");
        }
        if (!$shoppingBag) {
            $this->redirect("/checkout?error=7");
        }
        $address = $street . " " . $house . ", " . $apartment;

        foreach ($shoppingBag as $value) {

           if ($value->Quantity > $value->product->quantity) {
                $this->redirect("/checkout?error=5");
           }

            $order = new Order(null, $date, $value->product->price, $value->Quantity, $city, $address, 0, $value->product->id, $user->idUser, null, null);

            OrderRepository::add($order);

            ProductRepository::reduceQuantity($value->product->id, $value->Quantity);

            ShoppingBagRepository::deleteShoppingBag($value->product->id ,$user->idUser);
        }



        $this->redirect("/");

    }

}