<?php

namespace App\System\Classes;

use App\System\Interfaces\IView;

class View implements IView {

    private $_response;

    public function __construct() {
        $this->_response = new Response();
    }

    public function render($templateName, array $params = array()) {
        $this->_response->setCode(200);
        $this->_response->setHeader('Content-type', 'text/html');

        ob_start();

        if(!empty($params))
            extract($params);

        include __DIR__ . '/../../views/' . $templateName . '.php';

        $this->_response->setBody(ob_get_contents());
        ob_end_clean();
        $this->_response->send();
    }
}