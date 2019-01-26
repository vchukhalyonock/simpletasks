<?php

namespace App\System\Classes;

use App\System\Interfaces\IModel;

abstract class Model implements IModel {

    protected $dbInstance;
    protected $tableName;

    public function __construct() {
        try {
            $this->dbInstance = Db::instance();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function find(array $params = array()) {
        // TODO: Implement find() method.
    }

    public function delete($id) {
        // TODO: Implement delete() method.
    }

    public function get($id) {
        // TODO: Implement get() method.
    }

    public function create(array $params = array()) {
        // TODO: Implement create() method.
    }

    public function update($id, array $params = array()) {
        // TODO: Implement update() method.
    }
}