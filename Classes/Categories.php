<?php


namespace Classes;


class Categories extends Model
{
    public function all()
    {
        return $this->conn->query("SELECT * FROM `categories`");
    }

    public function find($id)
    {
        return $this->conn->query("SELECT * FROM `categories` WHERE id='{$id}'");
    }
    public function limitCate($limit)
    {
        return $this->conn->query("SELECT * FROM `categories` LIMIT $limit");
    }
    function menuCate($parent_id)
    {
        global $link;
        $query="SELECT * FROM categories WHERE `parent_id`='{$parent_id}'";
        $result = mysqli_query($link, $query);
        return $result;
    }
    public function updateCate($id, $title,$show_at_index,$comment,$parent_id)
    {
        $query = "UPDATE `categories` SET 
        `title` = '{$title}', 
	    `show_at_index` = '{$show_at_index}',
        `comment` = '{$comment}',
        `parent_id`= $parent_id
         WHERE `id` = '{$id}'";

        return $this->conn->query($query);
    }
     public function deleteCate($cate_id)
    {
        $query = "DELETE FROM `categories` WHERE `id`='{$cate_id}'";
        return $this->conn->query($query);
    }
    public function insertCate($title,$show_at_index,$comment,$parent_id)
    {
        $qeury="INSERT INTO categories(parent_id,title,show_at_index,create_at,comment) values('{$parent_id}','{$title}','{$show_at_index}','".date('Y-m-d H:i:s')."','$comment')";
        return $this->conn->query($qeury);
    }




}