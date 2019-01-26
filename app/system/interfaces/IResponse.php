<?php

namespace App\System\Interfaces;

interface IResponse {

    public function setHeader($header, $value);
    public function setCode($code);
    public function setBody($body);
    public function send();
}