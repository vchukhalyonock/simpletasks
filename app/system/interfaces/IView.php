<?php

namespace App\System\Interfaces;

interface IView {
    public function render($templateName, array $params = array());
}