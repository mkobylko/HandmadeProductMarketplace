<?php

namespace models;

class Product
{

    public $id;
    public $name;
    public $dimension;
    public $price;
    public $avgMark;
    public $description;
    public $photo;
    public $quantity;
    public $idCategory;
    public $idUser;

    public function __construct($id, $name, $dimension, $price, $avgMark, $description, $photo, $quantity, $idCategory, $idUser)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dimension = $dimension;
        $this->price = $price;
        $this->avgMark = $avgMark;
        $this->description = $description;
        $this->photo = $photo;
        $this->quantity = $quantity;
        $this->idCategory = $idCategory;
        $this->idUser = $idUser;
    }


}