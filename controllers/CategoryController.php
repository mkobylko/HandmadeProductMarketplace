<?php

namespace controllers;

use core\CategoryRepository;
use core\Controller;
use core\UserRepository;
use models\Category;

class CategoryController extends Controller
{
    public function addAction()
    {
        if (!$this->authenticated(true)) {
            http_response_code(500);
            echo "Лише адміни можуть додавати категорії";
            die();
        }

        $categoryName = $_REQUEST['category'];
        $category = new Category(-1, $categoryName);

        if ($category->name === null) {
            http_response_code(500);
            echo "Не вказана категорія";
            die();
        }
        if (CategoryRepository::getByName($category->name) != null) {
            http_response_code(500);
            echo "Категорія вже існує";
            die();
        }

        $category = CategoryRepository::add($category);
        echo json_encode($category);
    }
}
