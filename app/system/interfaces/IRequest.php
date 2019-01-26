<?php

namespace App\System\Interfaces;

interface IRequest {
    public function __construct();
    public function get($paramName = null);
    public function post($paramName = null);
    public function headers();
    public function path();
    public function method();
}