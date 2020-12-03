<?php

namespace Classes;


class DB {

    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new \PDO('mysql:host=localhost;dbname=pars;charset=utf8', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}