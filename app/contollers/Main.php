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
    }

    public function index() {
        $offset = $this->request()->get('page')
            ? ($this->request()->get('page') - 1) * $this->_onPage
            : 0;

        switch ($this->request()->get('sort')) {
            case 'name':
                $order = 'name';
                break;

            case 'email':
                $order = 'email';
                break;

            case 'status':
                $order = 'status';
                break;

            default:
                $order = 'id';
                break;
        }

        switch ($this->request()->get('direction')) {
            case 'asc':
            default:
                $orderDirection = 'ASC';
                break;

            case 'desc':
                $orderDirection = 'DESC';
                break;
        }

        $allTasks = $this->_tasks->find([
            'limit' => $this->_onPage,
            'offset' => $offset,
            'order' => "{$order} {$orderDirection}"
        ]);
        $this->render('main', ['tasks' => $allTasks]);
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