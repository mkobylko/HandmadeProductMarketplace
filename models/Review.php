<?php
namespace models;

class Review
{
    public $id;
    public $mark;
    public $date;
    public $text;
    public $idGood;
    public $idUser;
    public $user;
    public $product;

    public function __construct($id, $mark, $date, $text, $idGood, $idUser, $user, $product)
    {
        $this->id = $id;
        $this->mark = $mark;
        $this->date = $date;
        $this->text = $text;
        $this->idGood = $idGood;
        $this->idUser = $idUser;
        $this->user = $user;
        $this->product = $product;
    }


}