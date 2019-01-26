<?php

namespace App\System\Interfaces;

interface IDb {
    static public function instance();
    public function insert(array $query = array());
    public function update(array $query = array());
    public function find(array $query = array());
    public function delete(array $query = array());
}