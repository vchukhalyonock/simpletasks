<?php

namespace App\System\Interfaces;

interface IModel {

    public function create(array $params = array());
    public function update($id, array $params = array());
    public function get($id);
    public function find(array $params = array());
    public function delete($id);
}