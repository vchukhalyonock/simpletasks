<?php

namespace App\Controllers;

use App\Models\Tasks;
use App\System\Classes\Controller;

class Admin extends Controller {

    private $_login = 'admin';
    private $_password = '123';
    private $_tasks;

    public function __construct() {
        session_start();
        parent::__construct();
        $this->_tasks = new Tasks();
    }


    public function index() {
        if($this->_isLoggedIn()) {
            $this->render('admin');
        } else {
            $this->render('admin_login');
        }
    }


    public function task() {
        $this->responseJSON(['task' => $this->_tasks->get($this->request()->get('id'))]);
    }


    public function update() {
        try {
            $this->_tasks->update(
                $this->request()->post('id'),
                [
                    'task' => $this->request()->post('task'),
                    'status' => $this->request()->post('status') ? 'done' : 'new'
                ]
            );
        } catch (\Exception $e) {
            $this->responseJSON(['error' => $e->getMessage()]);
        }

        $this->responseJSON(['result' => true]);
    }


    public function login() {
        if($this->_login == $this->request()->post('login') &&
            $this->_password == $this->request()->post('password')) {
            $_SESSION['loggedIn'] = true;
        }

        $this->response()->setHeader('Location', '/admin/');
        $this->response()->send();
    }

    public function logout() {
        session_destroy();
        $this->response()->setHeader('Location', '/admin/');
        $this->response()->send();
    }


    private function _isLoggedIn() {
        return isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
    }
}