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
    function updatePost($id, $title, $short_description, $description,$select_cate)
    {
        $query = "UPDATE `posts` SET 
        `categories_id` = '{$select_cate}',
        `title` = '{$title}', 
        `short_description` = '{$short_description}',
        `description` = '{$description}'
         WHERE `id` = '{$id}'";
        return $this->conn->query($query);

    }
    function storePost($title,$short_description,$description,$file,$select_cate)
    {
        $extension = explode('.', $file);
        $extension = end($extension);
        $file_name = time() . '.' . $extension;
        $upload = "posts/image-post/'.'$file_name";
        !is_dir("posts/image-post") ? mkdir("image-post") : '';
        if(move_uploaded_file($_FILES['file']['tmp_name'], $upload) == true) {
            $query = "INSERT INTO `posts`(`id`,`categories_id`, `title`, `short_description`, `description`, `count_views`, `pic_url`, `created_at`) VALUES
      (NULL,'{$select_cate}', '{$title}', '{$short_description}', '{$description}', '0', '$file_name', '" . date('Y-m-d H:i:s') . "')";

            return $this->conn->query($query);
        }
        else
        {
            echo "<script>alert('آپبود فایل درست انجام نشد')</script>";
        }
    }
    function getPostsForIndex( $limit = null, $orderBy = null, $orderType = 'ASC') {

        $query = "SELECT P.* FROM `posts` AS P JOIN `categories` AS C  ON P.`categories_id`=C.`id`  WHERE C.`show_at_index` = 1";
        if(!is_null($orderBy)) {
            $query .= " ORDER BY `" . $orderBy . "` " . $orderType;
        }
        if(!is_null($limit)){
            $query .= " LIMIT " . $limit;
        }
        return $this->conn->query($query);

    }

}