<?php

namespace App\System\Classes;

use App\System\Interfaces\IModel;

abstract class Model implements IModel {

    protected $dbInstance;
    protected $tableName;
    protected $idField = 'id';

    public function __construct() {
        try {
            $this->dbInstance = Db::instance();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function find(array $params = array()) {
        try {
            $findResult = $this->dbInstance->find(
                $this->tableName,
                $params
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $findResult;
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function delete($id) {
        try {
            $this->dbInstance->delete(
                $this->tableName,
                ['where' => $this->idField . "='{$id}'"]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * @param $id
     * @return mixed|null
     * @throws \Exception
     */
    public function get($id) {
        try {
            $findResult = $this->dbInstance->find(
                $this->tableName,
                [
                    'limit' => 1,
                    'where' => $this->idField . "='{$id}'"
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $findResult && is_array($findResult) ? $findResult[0] : null;
    }

    /**
     * @param array $params
     * @throws \Exception
     */
    public function create(array $params = array()) {
        try {
            $this->dbInstance->insert(
                $this->tableName,
                $params
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param array $params
     * @throws \Exception
     */
    public function update($id, array $params = array()) {
        try {
            $this->dbInstance->update(
                $this->tableName,
                [
                    'fields' => $params,
                    'where' => $this->idField . "='{$id}'"
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * @return int
     * @throws \Exception
     */
    public function total() {
        try {
            $res = $this->dbInstance->rawSQL("SELECT COUNT(*) as count FROM {$this->tableName}");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $res ? $res[0]['count'] : 0;
    }
}