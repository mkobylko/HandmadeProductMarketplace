<?php

namespace controllers;

use core\Controller;
use core\ProductRepository;
use core\ReviewRepository;
use core\UserRepository;
use models\Review;


class ReviewsController extends Controller
{
    public function indexAction()
    {
        if ($_REQUEST['sort'] == 'asc') {
            $reviews = ReviewRepository::getAllReviews("ASC");
        } else if ($_REQUEST['sort'] == 'desc') {
            $reviews = ReviewRepository::getAllReviews("DESC");
        } else {
            $reviews = ReviewRepository::getAllReviews(null);
        }

        $this->render("views/reviews.php", [
            'reviews' => $reviews,
            'user' => $this->getUser()
        ]);
    }

    public function getAllAction()
    {
        $reviews = ReviewRepository::getReviewsByProduct($_REQUEST['productId']);
        echo json_encode($reviews);
    }

    public function addAction()
    {
        if (!$this->authenticated()) {
            return;
        }
        $user = $this->getUser();
        $user->password = null; // for security set password to null

        $date = date('Y-m-d H:i:s', time());
        $text = $_REQUEST['message'];
        $mark = $_REQUEST['mark'];
        $productId = $_REQUEST['productId'];

        $review = new Review(null, $mark, $date, $text, $productId, $user->idUser, $user, null);
        ReviewRepository::addReview($review);

        ProductRepository::updateMark($productId);

        echo json_encode($review);

    }

    public function removeAction()
    {
        if (!$this->authenticated(true)) {
            return;
        }
        $idReview = $_REQUEST['idReview'];

        ReviewRepository::removeReview($idReview);
    }

}