<?php

namespace App\System\Classes;

use App\System\Interfaces\IDb;

class Db {

    static private $_dbInstance = null;

    private function __construct(){
    }

    /**
     * @return IDb
     * @throws \Exception
     */
    static public function instance() {
        if(is_null(self::$_dbInstance)) {
            $dbDriver = getenv('DB_DRIVER');
            $class = 'App\\System\\Libs\\Dbdrivers\\' . ucfirst($dbDriver);
            if(class_exists($class)  && in_array('App\\System\\Interfaces\\IDb', class_implements($class))) {
                self::$_dbInstance = new $class();
            } else {
                throw new \Exception('DB Driver does not exist');
            }
        }

        return self::$_dbInstance;
    }
}