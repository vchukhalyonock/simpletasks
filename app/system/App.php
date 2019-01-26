<?php

namespace App\System;

use App\System\Classes\Request;
use App\System\Classes\Response;
use App\System\Classes\Router;

class App {

    private $_request;
    private $_router;
    private $_controller;

    public function __construct() {
        $this->_request = new Request();
        $this->_router = new Router($this->_request);
        if(class_exists('App\\Controllers\\' . $this->_router->getController())) {
            $controller = 'App\\Controllers\\' . $this->_router->getController();
            $this->_controller = new $controller();
            if(method_exists($this->_controller, $this->_router->getMethod())) {
                $method = $this->_router->getMethod();
                $this->_controller->$method();
                return;
            }
        }

        $response = new Response();
        $response->setCode(404);
        $response->setBody("Page not found");
        $response->send();
    }
}