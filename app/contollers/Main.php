<?php

namespace App\Controllers;

use App\System\Classes\Controller;

class Main extends Controller {

    public function index() {
        $this->render('main');
    }
}