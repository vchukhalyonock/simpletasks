<?php

namespace App\System\Classes;

use App\System\Interfaces\IResponse;

class Response implements IResponse {

    private $_headers = [];
    private $_code = 200;
    private $_body = '';

    public function send() {
        http_response_code($this->_code);
        foreach ($this->_headers as $key => $value)
            header("{$key}: {$value}");
        echo $this->_body;
    }

    public function setBody($body) {
        $this->_body =strval($body);
    }

    public function setCode($code) {
        $this->_code = intval($code);
    }

    public function setHeader($header, $value) {
        $this->_headers[$header] = $value;
    }
}