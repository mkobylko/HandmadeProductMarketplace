<?php

namespace core;

use models\Category;

class CategoryRepository
{

    public static function getAll()
    {

        $db = Database::getInstance();
        $sql = "SELECT * FROM Categories";
        $result = $db->select($sql, fn($row) => CategoryRepository::convert($row));

        return $result;
    }

    public static function getByName($name)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Categories WHERE Name = '{$name}'";
        return $db->selectSingle($sql, fn($row) => CategoryRepository::convert($row));
    }


    public static function add($category)
    {
        $db = Database::getInstance();
        $sql = "Insert into Categories (Name) 
                Values  ('{$category->name}')";

        $db->query($sql);
        $category->id = $db->conn->insert_id;

        return $category;
    }

    static function convert($row) {
        return new Category($row['idCategory'], $row['Name']);
    }

}