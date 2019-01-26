<?php

namespace App\System\Classes;

use App\System\Interfaces\IRequest;

/**
 * Class Request
 * @package App\System\Classes
 */
class Request implements IRequest {

    const GET = 'get';
    const POST = 'post';

    private $_headers = null;
    private $_method = null;
    private $_getParameters = [];
    private $_postParameters = [];
    private $_path = null;

    public function __construct() {
        $this->_setHeaders();
        $this->_setMethod();
        $this->_setPath();
    }

    /**
     *
     */
    private function _setHeaders() {
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(
                ' ',
                '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5))))
            );
            $this->_headers[$header] = $value;
        }
        return;
    }


    /**
     *
     */
    private function _setMethod() {
        $this->_method = mb_strtolower($_SERVER['REQUEST_METHOD']);
        return;
    }


    /**
     *
     */
    private function _setPath() {
        $this->_path = $_SERVER['REQUEST_URI'];
        return;
    }


    /**
     *
     */
    private function _setGetParameters() {
        $this->_getParameters = $_GET;
        return;
    }


    /**
     *
     */
    private function _setPostParameters() {
        if($this->_method == self::POST) {
            $this->_postParameters = $_POST;
        }
        return;
    }

    /**
     * @param null $paramName
     * @return array|mixed|null
     */
    public function get($paramName = null) {
        if(is_null($paramName))
            return $this->_getParameters;
        elseif (array_key_exists($paramName, $this->_getParameters))
            return $this->_getParameters[$paramName];
        else
            return null;
    }

    /**
     * @param null $paramName
     * @return array|mixed|null
     */
    public function post($paramName = null) {
        if(is_null($paramName))
            return $this->_postParameters;
        elseif (array_key_exists($paramName, $this->_postParameters))
            return $this->_postParameters[$paramName];
        else
            return null;
    }

    /**
     * @return null | array
     */
    public function headers() {
        return $this->_headers;
    }

    /**
     * @return null | string
     */
    public function path() {
        return $this->_path;
    }

    /**
     * @return null | string
     */
    public function method() {
        return $this->_method;
    }
}