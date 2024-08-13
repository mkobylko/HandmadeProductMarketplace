<?php

namespace controllers;

use core\Controller;
use core\StatisticsRepository;

class StatisticsController extends Controller
{
    public function indexAction()
    {

        if (!$this->authenticated(true)) {
            return;
        }

        $ordersAndCity = StatisticsRepository::getOrdersAndCity();

        $orderAndCategory = StatisticsRepository::getOrdersByCategories();

        $quantityOfAn = StatisticsRepository::getQuantityOfAnnouncement();

        $sellers = StatisticsRepository::getSellers();

       $params = compact("ordersAndCity", "orderAndCategory", "quantityOfAn", "sellers");

        $this->render("views/statistics.php", $params);

    }

}