<?php

namespace core;

use models\Product;
use models\Order;
use models\User;

class OrderRepository
{
    public static function add($order)
    {

        $db = Database::getInstance();
        $sql = "Insert into Orders(Date, OrderPrice, Quantity, City, Street, Status, idGood, idUser) 
                Values ('{$order->date}', {$order->sumPrice}, {$order->quantity}, '{$order->city}',
                        '{$order->street}', '{$order->status}', '{$order->idProduct}','{$order->idBuyer}')";

        $db->query($sql);
        $order->idOrder = $db->conn->insert_id;

        return $order;
    }

    public static function getSoldByUser($userId)
    {
        $db = Database::getInstance();
        $sql = "select *, Products.idUser as ProductIdUser, Orders.idUser as OrderIdUser, Users.idUser as UserIdUser FROM Orders
                inner join Products on Orders.idGood = Products.idGood
                inner join Users on Users.idUser = Orders.idUser
                where Products.idUser = $userId
                ORDER BY Status";

        return $db->select($sql, function ($row) {
            $user = new User($row['UserIdUser'], $row['Login'], $row['Password'], $row['Email'], $row['FullName'], $row['Type'], 0);
            $product = new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['ProductIdUser']);
            return new Order($row['idOrder'], $row['Date'], $row['OrderPrice'], $row['Quantity'], $row['City'], $row['Street'], $row['Status'], $row['idGood'], $row['OrderIdUser'], $product, $user);
        });
    }

    public static function getMadeByUser($idUser)
    {
        $db = Database::getInstance();

        $sql = "select *, Products.idUser as ProductIdUser, Orders.idUser as OrderIdUser FROM Orders
                inner join Products on Products.idGood = Orders.idGood
                where Orders.idUser = '{$idUser}'";

        return $db->select($sql, function ($row) {
            $product = new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['ProductIdUser']);
            return new Order($row['idOrder'], $row['Date'], $row['OrderPrice'], $row['Quantity'], $row['City'], $row['Street'], $row['Status'], $row['idGood'], $row['OrderIdUser'], $product, null);
        });
    }

    public static function updateStatus($orderId)
    {
        $db = Database::getInstance();
        $sql = "update Orders
                set Status = 1
                where idOrder = '$orderId'";

        $db->query($sql);

    }


    public static function getArchivedPurchases($idUser)
    {
        $db = Database::getInstance();

        $sql = "select *, Products.idUser as ProductIdUser, OrdersArchive.idUser as OrderIdUser FROM OrdersArchive
                inner join Products on Products.idGood = OrdersArchive.idGood
                where OrdersArchive.idUser = '{$idUser}'";

        $result = $db->query($sql);
        $orders = array();

        while ($row = $result->fetch_assoc()) {
            $product = new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['ProductIdUser']);
            $order = new Order($row['idOrder'], $row['Date'], $row['OrderPrice'], $row['Quantity'], $row['City'], $row['Street'], $row['Status'], $row['idGood'], $row['OrderIdUser'], $product, null);

            $orders[] = $order;
        }

        return $orders;

    }

    public static function getArchivedSales($idUser)
    {
        $db = Database::getInstance();

        $sql = "select *, Products.idUser as ProductIdUser, OrdersArchive.idUser as OrderIdUser, Users.idUser as UserIdUser FROM OrdersArchive
                inner join Products on OrdersArchive.idGood = Products.idGood
                inner join Users on Users.idUser = OrdersArchive.idUser
                where Products.idUser = '{$idUser}'
                ORDER BY Status ";

        $result = $db->query($sql);
        $orders = array();

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['UserIdUser'], $row['Login'], $row['Password'], $row['Email'], $row['FullName'], $row['Type'], 0);
            $product = new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['ProductIdUser']);
            $order = new Order($row['idOrder'], $row['Date'], $row['OrderPrice'], $row['Quantity'], $row['City'], $row['Street'], $row['Status'], $row['idGood'], $row['OrderIdUser'], $product, $user);

            $orders[] = $order;
        }


        return $orders;

    }


}
