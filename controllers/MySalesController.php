<?php

namespace controllers;

use core\Controller;
use core\StatisticsRepository;
use core\OrderRepository;

class mySalesController extends Controller
{
    public function indexAction()
    {

        if (!$this->authenticated()) {
            return;
        }

        $user = $this->getUser();

        //order -> idGood -> Good -> idUser - ти
        $orders = OrderRepository::getSoldByUser($user->idUser);

        $oneMonthAgo = StatisticsRepository::getOrdersByUserOneMonthAgo($user);
        $monthsAgo = StatisticsRepository::getOrdersByUserMonthsAgo($user);

        $params = compact("user", "orders", "oneMonthAgo", "monthsAgo");
        $this->render("views/mySales.php", $params);

    }

    public function statusCheckedAction() {

        if (!$this->authenticated()) {
            return;
        }

        $orderId = $_REQUEST["orderId"];

        OrderRepository::updateStatus($orderId);
    }


    public function archiveAction()
    {

        if (!$this->authenticated()) {
            return;
        }
        $user = $this->getUser();


        $archives = OrderRepository::getArchivedSales($user->idUser);

        foreach ($archives as $archive){
            $archive->product->photo = base64_encode($archive->product->photo);
        }
        echo json_encode($archives);
    }
}