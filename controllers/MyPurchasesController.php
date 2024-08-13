<?php
namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\ProductRepository;
use core\ReviewRepository;
use core\UserRepository;
use core\OrderRepository;
use models\Review;

class myPurchasesController extends Controller
{
    public function indexAction()
    {
        if (!$this->authenticated()) {
            return;
        }

        $user = $this->getUser();

        $orders = OrderRepository::getMadeByUser($user->idUser);

        $params = compact("user", "orders");
        $this->render("views/myPurchases.php", $params);

    }
    public function archiveAction()
    {

        if (!$this->authenticated()) {
            return;
        }
        $user = $this->getUser();


        $archives = OrderRepository::getArchivedPurchases($user->idUser);
        foreach ($archives as $archive){
            $archive->product->photo = base64_encode($archive->product->photo);
        }

        echo json_encode($archives);
    }
}