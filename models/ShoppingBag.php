<?php
namespace models;

class ShoppingBag
{

    public $id;
    public $idGood;
    public $idUser;
    public $Quantity;
    public $sumPrice;
    public $product;


    public function __construct($id, $idGood, $idUser, $Quantity, $sumPrice, $product)
    {
        $this->id = $id;
        $this->idGood = $idGood;
        $this->idUser = $idUser;
        $this->Quantity = $Quantity;
        $this->sumPrice = $sumPrice;
        $this->product = $product;
    }


}
?>

