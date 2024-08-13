<?php

namespace models;

class User
{
    public $idUser;
    public $login;
    public $password;
    public $email;
    public $type;
    public $fullName;
    public $banned;


    public function __construct($idUser, $login, $password, $email, $type, $fullName, $banned)
    {
        $this->idUser = $idUser;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->type = $type;
        $this->fullName = $fullName;
        $this->banned = $banned;
    }


    public function isAdmin() {
        return $this->type == 1;
    }
}