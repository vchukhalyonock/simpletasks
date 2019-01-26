<?php

namespace App\Controllers;

use App\System\Classes\Controller;

class Main extends Controller {

    public function index() {
        /*$this->response()->setBody('Main default controller');
        $this->response()->send();*/
        $this->render('main');
    }
}