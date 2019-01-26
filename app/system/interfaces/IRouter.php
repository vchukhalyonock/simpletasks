<?php

namespace App\System\Interfaces;

interface IRouter {

    public function __construct(IRequest $request);
    public function getController();
    public function getMethod();
}