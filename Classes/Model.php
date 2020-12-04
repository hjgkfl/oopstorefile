<?php

namespace Classes;

class Model
{
    public $conn;
    const Role_user=0;
    const Role_admin=1;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}