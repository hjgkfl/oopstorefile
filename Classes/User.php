<?php


namespace Classes;


class User extends Model
{
    function userGet($name)
    {
        $query = "SELECT * FROM `users` WHERE `l-f-name`='{$name}' ";
       return $this->conn->query($query);
    }
    function all()
    {
        $query = "SELECT * FROM `users`";
        return $this->conn->query($query);
    }
}