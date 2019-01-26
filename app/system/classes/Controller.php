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
    protected $_view;

    /**
     * Controller constructor.
     */
    public function __construct() {
        $this->_request = new Request();
        $this->_response = new Response();
        $this->_view = new View();
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


    /**
     * @param $templateName
     * @param array $params
     */
    protected function render($templateName, array $params = array()) {
        $this->_view->render($templateName, $params);
    }


    /**
     * @param $data
     * @param int $code
     */
    protected function responseJSON($data, $code = 200) {
        $this->response()->setHeader("Content-Type", "application/json");
        $this->response()->setCode($code);
        $this->response()->setBody(json_encode($data));
        $this->response()->send();
    }
}