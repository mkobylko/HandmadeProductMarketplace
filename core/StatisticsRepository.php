<?php

namespace core;

class StatisticsRepository
{

    public static function getOrdersAndCity()
    {
        $db = Database::getInstance();

        $sql = "select city, count(city) as countF from 
                (select * from orders
                union select * from ordersArchive) as ad
                group by city
                order by countF desc";


        $result = $db->query($sql);

        $cityAndQuantity = array();


        while ($rowReview = $result->fetch_assoc()) {
            $city = $rowReview['city'];
            $quantity = $rowReview['countF'];
            $cityAndQuantity[$city] = $quantity;
        }

        return $cityAndQuantity;
    }


    public static function getOrdersByUserMonthsAgo($user){
        $db = Database::getInstance();
        $resultsss = array();

        for ($i = -1; $i >= -4; $i--)
        {
            $sql = "SELECT count(orders.idOrder) as CountOfOrder from orders 
            INNER JOIN Products ON Products.idGood = orders.idGood
            WHERE MONTH(orders.Date) = MONTH(DATE_ADD(NOW(), INTERVAL '{$i}' MONTH)) AND YEAR(orders.Date) = YEAR(NOW()) 
            AND Products.idUser = '{$user->idUser}'
            
            UNION 
            
            SELECT count(ordersArchive.idOrder) as CountOfOrder from ordersArchive
            INNER JOIN Products ON Products.idGood = ordersArchive.idGood
            WHERE MONTH(ordersArchive.Date) = MONTH(DATE_ADD(NOW(), INTERVAL '{$i}' MONTH)) AND YEAR(ordersArchive.Date) = YEAR(NOW())
            AND Products.idUser = '{$user->idUser}'";

            $result = $db->query($sql);
            $totalOrderCount = 0;

            while ($row = $result->fetch_assoc()) {
                $totalOrderCount += intval($row['CountOfOrder']);
            }

            $resultsss[$i] =  $totalOrderCount;
        }

        return $resultsss;
    }

    public static function getOrdersByUserOneMonthAgo($user){

        $db = Database::getInstance();

        $sql = "select count(idOrder) as CountOfOrder from orders
            inner join Products on Products.idGood = orders.idGood
            WHERE MONTH(orders.Date) = MONTH(DATE_ADD(NOW(), INTERVAL 0 MONTH)) AND YEAR(orders.Date) = YEAR(NOW())
            and Products.idUser = '{$user->idUser}' ";

        $result = $db->query($sql);

        $row = $result->fetch_row();

        $totalOrderCount = intval($row[0]);

        return $totalOrderCount;
    }

    public static function getOrdersByCategories(){

        $db = Database::getInstance();

        $sql = "SELECT DISTINCT(Categories.Name), count(orders.idOrder) as quantity from orders 
            inner join Products on Products.idGood = orders.idGood
            inner join Categories on Categories.idCategory = Products.idCategory
            group by Categories.Name;";


        $result = $db->query($sql);


        $categoryAndQuantity = array();

        while ($row = $result->fetch_assoc()) {
            $name = $row['Name'];
            $quantity = $row['quantity'];
            $categoryAndQuantity[$name] = $quantity;
        }
        return $categoryAndQuantity;
    }

    public static function getQuantityOfAnnouncement()
    {
        $db = Database::getInstance();

        $sql = "select count(Products.Name) from Products
            where StorageQuantity > 0;";

        $result = $db->query($sql);

        $row = $result->fetch_row();

        $total = intval($row[0]);

        return $total;
    }

    public static function getSellers()
    {
        $db = Database::getInstance();

        $sql = "select login, count(Products.Name) as countOfProducts from Products
            inner join Users on Products.idUser = Users.idUser
            where Banned = 0 and StorageQuantity > 0  
            GROUP BY login 
            ORDER BY countOfProducts DESC
            LIMIT 7;";


        $result = $db->query($sql);


        $sellers = array();

        while ($row = $result->fetch_assoc()) {
            $login = $row['login'];
            $quantity = $row['countOfProducts'];
            $sellers[$login] = $quantity;
        }
        return $sellers;
    }

}