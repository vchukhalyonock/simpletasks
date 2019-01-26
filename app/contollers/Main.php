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
        /*$this->render('main', ['tasks' => $this->_tasks->find([
            'limit' => $this->_onPage,
            'offset' => 0
        ])]);*/
        $this->render('main', ['tasks' => []]);
    }


    public function create_task() {
        try {
            $this->_tasks->update(
                $this->request()->post('id'),
                [
                    'email' => $this->request()->post('email'),
                    'name' => $this->request()->post('name'),
                    'task' => $this->request()->post('task'),
                    'status' => 'new'
                ]
            );
        } catch (\Exception $e) {
            $this->response()->setBody('Somethig was wrong :' . $e->getMessage());
        }

        $this->render(
            'main',
            [
                'tasks' => $this->_tasks->find([])
            ]
        );
    }
}