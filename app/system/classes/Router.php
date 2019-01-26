<?php

namespace App\System\Classes;

use App\System\Interfaces\IRequest;
use App\System\Interfaces\IRouter;

class Router implements IRouter {

    private $_controller;
    private $_method;
    private $_request;

    /**
     * Router constructor.
     * @param IRequest $request
     */
    public function __construct(IRequest $request) {
        $this->_request = $request;
        $this->_setController();
        $this->_setMethod();
    }

    private function _setController() {
        $pathParts = explode("/", $this->_request->path());
        $this->_controller = isset($pathParts[1]) && !empty(trim($pathParts[1]))
            ? ucfirst(trim($pathParts[1]))
            : ucfirst(getenv('DEFAULT_CONTROLLER'));
    }

    private function _setMethod() {
        $pathParts = explode("/", $this->_request->path());
        $this->_method = isset($pathParts[2]) && !empty(trim($pathParts[2]))
            ? lcfirst(trim($pathParts[2]))
            : lcfirst(getenv('DEFAULT_METHOD'));
    }

    /**
     * @return mixed
     */
    public function getController() {
        return $this->_controller;
    }

    /**
     * @return mixed
     */
    public function getMethod() {
        return $this->_method;
    }
}