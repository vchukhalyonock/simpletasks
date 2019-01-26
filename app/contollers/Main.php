<?php

namespace App\Controllers;

use App\Models\Tasks;
use App\System\Classes\Controller;

class Main extends Controller {

    private $_tasks;
    private $_onPage = 3;

    public function __construct() {
        parent::__construct();
        $this->_tasks = new Tasks();
        $this->_onPage = getenv('ITEMS_ON_PAGE');
    }

    public function index() {
        $this->render('main', ['tasks' => []]);
    }
}