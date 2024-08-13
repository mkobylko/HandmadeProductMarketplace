<?php

namespace core;

use models\Product;

class ProductRepository
{

    public static function getByFilter($categoryId, $priceFrom, $priceTo, $name, $mark)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Products";

        $filter = [];
        if (!empty($categoryId)) {
            $filter[] = "idCategory = $categoryId";
        }
        if (!empty($priceFrom)) {
            $filter[] = "price >= $priceFrom";
        }
        if (!empty($priceTo)) {
            $filter[] = "price <= $priceTo";
        }
        if (!empty($name)) {
            $filter[] = "name LIKE '%$name%'";
        }
        if (!empty($mark)) {
            $filter[] = "AvgMark >= $mark";
        }
        if (count($filter) > 0) {
            $sql = $sql . " WHERE " . join(" AND ", $filter);
        }

        return $db->select($sql, fn($row) => ProductRepository::convert($row));
    }

    public static function getById($productId)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Products WHERE idGood = '$productId'";
        return $db->selectSingle($sql, fn($row) => ProductRepository::convert($row));
    }

    public static function getByUser($idUser)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Products WHERE idUser = '$idUser'";
        return $db->select($sql, fn($row) => ProductRepository::convert($row));
    }

    public static function add($product)
    {
        $db = Database::getInstance();
        $sql = "Insert into Products (Name, Dimension, Price, Description, Photo, StorageQuantity, idCategory, idUser) 
                Values ('{$product->name}', '{$product->dimension}', '{$product->price}', '{$product->description} ','{$product->photo}','{$product->quantity}','{$product->idCategory}', '{$product->idUser}')";

        $db->query($sql);
        $product->goodId = $db->conn->insert_id;

        return $product;
    }

    public static function reduceQuantity($productId, $quantity)
    {
        $db = Database::getInstance();
        $sql = "update Products
            set StorageQuantity = StorageQuantity - '{$quantity}'
            where idGood = '{$productId}'";
        $db->query($sql);
    }

    public static function updateProduct($product)
    {
        if ($product->photo !== null) {
            $photoUpdate = "Photo = '{$product->photo}',";
        }

        $db = Database::getInstance();
        $sql = "update Products
                set
                    Name = '{$product->name}',
                    Dimension = '{$product->dimension}',
                    Price = '{$product->price}', 
                    Description = '{$product->description} ',
                    $photoUpdate
                    StorageQuantity = '{$product->quantity}',
                    idCategory = '{$product->idCategory}'
                where idGood = '$product->id'";

        $db->query($sql);
    }

    public static function updateMark($productId)
    {
        $db = Database::getInstance();

        $sql = "select avg(mark) as averageMark from Reviews where idGood = $productId";
        $result = $db->query($sql);

        if ($result->num_rows == 0) {
            return;
        }

        $row = $result->fetch_assoc();
        $mark = $row['averageMark'];

        $sql = "update Products
                set avgMark = $mark
                where idGood = $productId";

        $db->query($sql);
    }


    static function convert($row)
    {
        return new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['idUser']);
    }

}