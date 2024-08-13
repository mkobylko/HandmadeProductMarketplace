<?php

namespace core;

use models\User;

class UserRepository
{
    public static function getByLogin($cookie): ?User
    {
        if ($cookie === null) {
            return null;
        }
        $split = explode(" ", $cookie);
        $login = $split[0];
        $password = $split[1];

        $db = Database::getInstance();
        $sql = "SELECT * FROM Users WHERE login = '{$login}' AND password = '$password'";
        return $db->selectSingle($sql, fn($row) => UserRepository::convert($row));
    }

    public static function add($user)
    {
        $db = Database::getInstance();
        $sql = "Insert into Users (Login, Password, Email, Type, FullName, Banned) 
                Values  ('{$user->login}', '{$user->password}', '{$user->email}', '{$user->type}', '{$user->fullName}', '0')";

        $db->query($sql);
        $user->userId = $db->conn->insert_id;

        return $user;
    }

    public static function getById($id): ?User
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Users WHERE idUser = '{$id}'";
        return $db->selectSingle($sql, fn($row) => UserRepository::convert($row));
    }

    public static function updateUser($user)
    {
        $db = Database::getInstance();

        $sql = "update Users set
                    Login = '{$user->login}',
                    Email = '{$user->email}',
                    FullName = '{$user->fullName}'
                where idUser = '{$user->idUser}' ";


        $db->query($sql);
        $user->idUser = $db->conn->insert_id;

        return $user;

    }

    public static function getAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Users";
        return $db->select($sql, fn($row) => UserRepository::convert($row));
    }

    public static function ban($userId, $value)
    {
        $db = Database::getInstance();

        $sql = "update Users set
                    Banned = '$value'
                where idUser = '{$userId}' ";

        $db->query($sql);
    }

    public static function isExistLogin($searchVal)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Users
                where Login = '{$searchVal}'";
        return $db->select($sql, fn($row) => UserRepository::convert($row));
    }
    public static function isExistEmail($searchVal)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Users
                where Email = '{$searchVal}'";
        return $db->select($sql, fn($row) => UserRepository::convert($row));
    }

    static function convert($row)
    {
        return new User($row['idUser'], $row['Login'], $row['Password'], $row['Email'], $row['Type'], $row['FullName'], $row['Banned']);
    }
}