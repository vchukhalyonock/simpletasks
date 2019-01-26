<?php

namespace App\System\Libs\Dbdrivers;

use App\System\Interfaces\IDb;

/**
 * Class Sqlite
 * @package App\System\Libs\Dbdrivers
 */
class Sqlite extends \SQLite3 implements IDb {

    /**
     * Sqlite constructor.
     */
    public function __construct() {
        $this->open(__DIR__ . '/../../../../' . getenv('DB_PATH') . '/' . getenv('DB_FILE'));
    }

    /**
     * @param $table
     * @param array $query
     * @return bool
     * @throws \Exception
     */
    public function insert($table, array $query = array()) {
        $fields = [];
        $values = [];
        foreach ($query as $key => $value) {
            $fields[] = $key;
            $values[] =  "'" . str_replace("'", "\'", $value) . "'";
        }

        $sql = "INSERT INTO " . strval($table) . " (" . implode(",", $fields) . ")"
            . " VALUES (" . implode("," , $values) . ")";

        $res = $this->exec($sql);

        if(!$res)
            throw new \Exception($this->lastErrorMsg());

        return true;
    }

    /**
     * @param $table
     * @param array $query
     * @return array
     * @throws \Exception
     */
    public function find($table, array $query = array()) {
        $selectFields = isset($query['select']) ? $query['select'] : '*';
        $where = isset($query['where']) ? ' WHERE ' . $query['where'] : '';
        $limit = isset($query['limit']) ? ' LIMIT ' . $query['limit'] : null;
        $offset = isset($query['offset']) ? ' OFFSET ' . $query['offset'] : null;
        $order = isset($query['order']) ? ' ORDER BY ' . $query['order'] : null;
        $result = [];

        $sql = "SELECT {$selectFields} FROM {$table} {$where} ";
        if(!is_null($order))
            $sql .= $order;

        if(!is_null($limit))
            $sql .= $limit;

        if(!is_null($offset))
            $sql .= $offset;

        $res = $this->query($sql);
        if(!$res)
            throw new \Exception($this->lastErrorMsg());

        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }


    /**
     * @param $table
     * @param array $query
     * @return bool
     * @throws \Exception
     */
    public function delete($table, array $query = array()) {
        $sql = "DELETE FROM {$table} ";
        if(isset($query['where']))
            $sql .= ' WHERE ' . $query['where'];

        $res = $this->exec($sql);

        if(!$res)
            throw new \Exception($this->lastErrorMsg());

        return true;
    }


    /**
     * @param $table
     * @param array $query
     * @return bool
     * @throws \Exception
     */
    public function update($table, array $query = array()) {
        $sql = "UPDATE {$table} SET ";

        if(!isset($query['fields']))
            return true;

        $setFields = [];
        foreach ($query['fields'] as $field => $value) {
            $setFields[] = "{$field}='" . str_replace("'", "\'", $value) . "'";
        }
        $sql .= implode(",", $setFields) . ' ';

        if(isset($query['where']))
            $sql .= " WHERE " . $query['where'];

        $res = $this->exec($sql);

        if(!$res)
            throw new \Exception($this->lastErrorMsg());

        return true;
    }


    /**
     * @param $sql
     * @return array
     * @throws \Exception
     */
    public function rawSQL($sql) {
        $result = [];
        $res = $this->query($sql);
        if(!$res)
            throw new \Exception($this->lastErrorMsg());

        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }


    /**
     *
     */
    public function __destruct() {
        $this->close();
    }
}