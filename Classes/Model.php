<?php

namespace Classes;

class Model
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}