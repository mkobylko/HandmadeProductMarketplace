<?php

namespace models;

class Order
{

    public $id;
    public $date;
    public $sumPrice;
    public $quantity;
    public $city;
    public $street;
    public $status;
    public $idProduct;
    public $idBuyer;

    //два об'єкта в класі (клас в класі в яких буде зберігатися екземпляр класу з бд)
    public $product;
    public $user;

    public function __construct($id, $date, $sumPrice, $quantity, $city, $street, $status, $idProduct, $idBuyer, $product, $user)
    {
        $this->id = $id;
        $this->date = $date;
        $this->sumPrice = $sumPrice;
        $this->quantity = $quantity;
        $this->city = $city;
        $this->street = $street;
        $this->status = $status;
        $this->idProduct = $idProduct;
        $this->idBuyer = $idBuyer;
        $this->product = $product;
        $this->user = $user;
    }


}
