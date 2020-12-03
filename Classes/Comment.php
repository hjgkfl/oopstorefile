<?php

namespace Classes;

class Comment extends Model
{
    public function all()
    {
        return $this->conn->query("SELECT * FROM `comments`");
    }

    public function getPostComment($post_id, $parent_id = NULL)
    {
        $query = "SELECT * FROM `comments` WHERE `post_id` = '{$post_id}' AND `is_confirm` = 1 ";
        if(is_null($parent_id)) {
            $query .= " AND `parent_id` = '0'";
        } else {
            $query .= " AND `parent_id` = '{$parent_id}' ";
        }
        return $this->conn->query($query);
    }

    public function store($params)
    {
        $query = "INSERT INTO `comments` VALUES
     (NULL,  '{$params['post_id']}','{$params['parent_id']}','{$params['name']}','{$params['mobile']}','{$params['email']}','{$params['description']}', '0', '" . date('Y-m-d H:i:s') . "')";

        return $this->conn->query($query);
    }

    public function pageNavi($post_id,$parent_id,$limit,$offset)
    {
        $query = "SELECT * FROM `comments` WHERE `post_id`=$post_id AND `is_confirm`= 1  AND `parent_id`=$parent_id  LIMIT  $limit OFFSET $offset ";
        return $this->conn->query($query);
    }

    function commentCount($page)
    {
        return ($page - 1) * 5;

    }
    function updateComment($description,$is_confirm,$id)
    {
        $query = "UPDATE `comments` SET 
        `description` = '{$description}',
        `is_confirm` = '{$is_confirm}'
         WHERE `id` = '{$id}'";
        return $this->conn->query($query);

    }
   

}