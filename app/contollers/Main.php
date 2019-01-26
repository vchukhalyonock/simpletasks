<?php

namespace App\Controllers;

use App\Models\Tasks;
use App\System\Classes\Controller;

class Main extends Controller {

    private $_tasks;

    public function __construct() {
        parent::__construct();
        $this->_tasks = new Tasks();
    }

    public function index() {
        $this->render('main', ['tasks' => []]);
    }
}