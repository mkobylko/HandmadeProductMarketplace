<?php


namespace core;

use models\Order;
use models\Product;
use models\User;
use models\ShoppingBag;

class ShoppingBagRepository
{

    public static function add($ShoppingBag)
    {

        $db = Database::getInstance();

        $sql = "
            call ShoppingBagByUserIdAndGoodId('{$ShoppingBag->idGood}', '{$ShoppingBag->idUser}', @result); 
            call QuantityOfProduct('{$ShoppingBag->idGood}', '{$ShoppingBag->idUser}', @productQuantity);
            call PriceOfProduct('{$ShoppingBag->idGood}', '{$ShoppingBag->idUser}', @productPrice);

            UPDATE ShoppingBag SET
                SumPrice = @productPrice + $ShoppingBag->sumPrice,
	            Quantity = @productQuantity + $ShoppingBag->Quantity
            where idUser = '{$ShoppingBag->idUser}' and idGood = '{$ShoppingBag->idGood}' and @result = 1;


            INSERT INTO ShoppingBag(idGood, idUser, Quantity, SumPrice) 
            SELECT'{$ShoppingBag->idGood}', '{$ShoppingBag->idUser}', '{$ShoppingBag->Quantity}', 
                        '{$ShoppingBag->sumPrice}'
            WHERE @result = 0;";

        $db->multi_query($sql);

        $ShoppingBag->idBasket = $db->conn->insert_id;

        return $ShoppingBag;
    }

    public static function getShoppingBagByUser($idUser)
    {
        $db = Database::getInstance();

        $sql = "select *, Products.idUser as ProductIdUser, ShoppingBag.idUser as ShoppingBagIdUser FROM ShoppingBag
                inner join Products on Products.idGood = ShoppingBag.idGood
                where ShoppingBag.idUser = '{$idUser}'";

        return $db->select($sql, function ($row) {
            $product = new Product($row['idGood'], $row['Name'], $row['Dimension'], $row['Price'], $row['avgMark'], $row['Description'], $row['Photo'], $row['StorageQuantity'], $row['idCategory'], $row['ProductIdUser']);
            return new ShoppingBag($row['idBasket'], $row['idGood'], $row['idUser'], $row['Quantity'], $row['SumPrice'], $product);
        });

    }
    public static function deleteShoppingBag($idProduct, $idUser)
    {
        $db = Database::getInstance();
        $sql = "delete from ShoppingBag where idGood = '$idProduct' and idUser = '$idUser'";

        $db->query($sql);
    }

    public static function getCountByUser($idUser)
    {
        $db = Database::getInstance();

        $sql = "select count(*) from ShoppingBag
            where idUser = '{$idUser}'";

        $result = $db->query($sql);

        $row = $result->fetch_row();

        $count = intval($row[0]);

        return $count;

    }


}
?>