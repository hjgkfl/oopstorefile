<?php

namespace Classes;

class Comment extends Model
{
    public function all()
    {
        return $this->conn->query("SELECT * FROM `comments`");
    }
    public function find($id)
    {
        return $this->conn->query("SELECT * FROM `comments` WHERE id='{$id}'");
    }
    public function getPostComment($post_id, $parent_id = NULL)
    {
        $query = "SELECT * FROM `comments` WHERE `post_id` = '{$post_id}' AND `is_confirm` = 1 ";
        if(is_null($parent_id)) {
            $query .= " AND `parent_id` = '0' ";
        } else {
            $query .= " AND `parent_id` = '{$parent_id}'";
        }
        return $this->conn->query($query);
    }

    public function storeComment($name_comment,$description_comment,$post_id,$email,$phone,$parent_id)
    {
        $query = "INSERT INTO `comments` (`post_id`,`parent_id`,`name`,`mobile`,`email`,`description`,`created_at`) VALUES('{$post_id}','{$parent_id}','{$name_comment}','{$phone}','{$email}','{$description_comment}','" . date('Y-m-d H:i:s') . "')";
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
    function deleteComment($comment_id) {
        $query = "DELETE FROM `comments` WHERE `id`='{$comment_id}'";
        return $this->conn->query($query);
    }


}