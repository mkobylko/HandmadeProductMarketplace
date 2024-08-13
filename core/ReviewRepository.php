<?php

namespace core;

use models\Product;
use models\Review;
use models\User;

class ReviewRepository
{

    public static function addReview($review)
    {
        $db = Database::getInstance();
        $sql = "insert into Reviews (Mark, Date, Text, idGood, idBuyer) Values ('{$review->mark}', '{$review->date}', '{$review->text}', '{$review->idGood} ','{$review->idUser}')";

        $db->query($sql);

        $review->idReviers = $db->conn->insert_id;

        return $review;
    }


    public static function getReviewsByProduct($productId)
    {

        $db = Database::getInstance();

        $sql = "select  * from Reviews
                inner join Users on idBuyer = idUser
                where idGood = $productId
                order by `date` desc";

        $result = $db->query($sql);
        $reviews = array();

        while ($rowReview = $result->fetch_assoc()) {
            $user = new User($rowReview['idUser'], $rowReview['Login'], null, $rowReview['Email'], $rowReview['Type'], $rowReview['FullName'], 0);
            $review = new Review($rowReview['idReview'], $rowReview['Mark'], $rowReview['Date'], $rowReview['Text'], $rowReview['idGood'], $rowReview['idBuyer'], $user, null);

            $reviews[] = $review;
        }

        return $reviews;
    }

    public static function getAllReviews($sort)
    {
        $db = Database::getInstance();
        if ($sort != null) {
            $addString = "ORDER BY Mark " . $sort;
        } else {
            $addString = ' ';
        }
        $sql = "select  * from Reviews
                inner join Users on idBuyer = idUser
                inner join Products on Reviews.idGood = Products.idGood
                $addString";

        $result = $db->query($sql);
        $reviews = array();

        while ($rowReview = $result->fetch_assoc()) {
            $user = new User($rowReview['idUser'], $rowReview['Login'], null, $rowReview['Email'], $rowReview['Type'], $rowReview['FullName'], 0);
            $product = new Product($rowReview['idGood'], $rowReview['Name'], $rowReview['Dimension'], $rowReview['Price'], $rowReview['avgMark'], $rowReview['Description'], $rowReview['Photo'], null, $rowReview['idCategory'], $rowReview['ProductIdUser']);

            $review = new Review($rowReview['idReview'], $rowReview['Mark'], $rowReview['Date'], $rowReview['Text'], $rowReview['idGood'], $rowReview['idBuyer'], $user, $product);
            $reviews[] = $review;
        }

        return $reviews;
    }

    public static function removeReview($idReview)
    {
        $db = Database::getInstance();
        $sql = "delete from Reviews where idReview = '$idReview'";

        $db->query($sql);
    }


}