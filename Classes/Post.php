<?php

namespace Classes;

class Post extends Model
{
    public function all()
    {
        return $this->conn->query("SELECT * FROM `posts`");
    }

    public function find($id)
    {
        return $this->conn->query("SELECT * FROM `posts` WHERE id='{$id}'");
    }

    public function calculateCountViews()
    {
        // implement calculateCountViews function ...
    }
}