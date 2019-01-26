<?php

namespace App\System\Classes;

use App\System\Interfaces\IController;

/**
 * Class Controller
 * @package App\System\Classes
 */
abstract class Controller implements IController {

    protected $_request;
    protected $_response;

    /**
     * Controller constructor.
     */
    public function __construct() {
        $this->_request = new Request();
        $this->_response = new Response();
    }

    /**
     * @return Request
     */
    protected function request() {
        return $this->_request;
    }

    /**
     * @return Response
     */
    protected function response() {
        return $this->_response;
    }
}