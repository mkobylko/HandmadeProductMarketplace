<?php

namespace core;


use controllers\MainController;

class Core
{
    private static $instance = null;
    public $app;
    public $pageParams;
    public $requestMethod;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function Initialize()
    {
        session_start();
    }

    public function Run()
    {
        $route = $_GET['route'];
        $routeParts = explode('/', $route);
        $moduleName = array_shift($routeParts);
        $actionName = array_shift($routeParts);


        if (empty($actionName)) {
            $actionName = "index";
        }
        if (empty($moduleName)) {
            $moduleName = "main";
        }
        $controllerName = "\\controllers\\" . ucfirst($moduleName) . 'Controller';
        $controllerActionName = $actionName . 'Action';

        $statusCode = 200;

        if (class_exists($controllerName)) {
            $controller = new $controllerName();

            if (method_exists($controller, $controllerActionName)) {
                $controller->$controllerActionName();
                if (http_response_code() != 200) {
                    $statusCode = http_response_code();
                }
            }
            else {
                $statusCode = 404;
            }
        } else {
            $statusCode = 404;
        }

        $statusCodeType = (intval($statusCode / 100));

        if ($statusCodeType == 4 || $statusCodeType == 5) {
            $mainController = new MainController();
            $mainController->errorAction($statusCode);
        }
    }

    public function Done()
    {
    }
}























