<?php

namespace App\Controllers;

use App\Models\Tasks;
use App\System\Classes\Controller;

/**
 * Class Ajax
 * @package App\Controllers
 */
class Ajax extends Controller {

    private $_tasks;
    private $_onPage = 3;

    /**
     * Ajax constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->_tasks = new Tasks();
        $this->_onPage = getenv('ITEMS_ON_PAGE');
    }

    /**
     *
     */
    public function tasks() {
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
            'limit' => $this->request()->get('length') ? $this->request()->get('length') : $this->_onPage,
            'offset' => $this->request()->get('start') ? $this->request()->get('start') : 0,
            'order' => "{$order} {$orderDirection}"
        ]);

        $total = $this->_tasks->total();

        $this->responseJSON([
            'data' => $allTasks,
            'recordsTotal' => $total,
            'recordsFiltered' => $total
        ]);
    }
}