<?php

namespace App\System\Interfaces;

interface IDb {
    public function insert($table, array $query = array());
    public function update($table, array $query = array());
    public function find($table, array $query = array());
    public function delete($table, array $query = array());
}