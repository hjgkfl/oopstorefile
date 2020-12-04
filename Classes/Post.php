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

    public function calculateCountViews($post_id) {

        $viewed_pages = [];
        if(isset($_COOKIE['viewed_pages'])) {
            $viewed_pages = json_decode($_COOKIE['viewed_pages'], true);
        }
        if(!in_array($post_id, $viewed_pages)) {

            $query = "UPDATE `posts` SET 
        `count_views` = `count_views` + 1
         WHERE `id` = '{$post_id}'";

            $result = $this->conn->query($query);
            $viewed_pages[] = $post_id;
            setcookie('viewed_pages', json_encode($viewed_pages), time() + 3 * 24 * 3600);
        }
        return $result;

    }

    public function updatePost($id, $title, $short_description, $description,$select_cate)
    {
        $query = "UPDATE `posts` SET 
        `categories_id` = '{$select_cate}',
        `title` = '{$title}', 
        `short_description` = '{$short_description}',
        `description` = '{$description}'
         WHERE `id` = '{$id}'";
        return $this->conn->query($query);

    }
    public function storePost($title,$short_description,$description,$file,$select_cate)
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
    public function getPostsForIndex( $limit = null, $orderBy = null, $orderType = 'ASC') {

        $query = "SELECT P.* FROM `posts` AS P JOIN `categories` AS C  ON P.`categories_id`=C.`id`  WHERE C.`show_at_index` = 1";
        if(!is_null($orderBy)) {
            $query .= " ORDER BY `" . $orderBy . "` " . $orderType;
        }
        if(!is_null($limit)){
            $query .= " LIMIT " . $limit;
        }
        return $this->conn->query($query);

    }

    public function searchPost($search)
    {
        $query = "SELECT * FROM `posts` WHERE `description` LIKE  '%$search%' ";
        $result=$this->conn->query($query);
        $num_rows_result=$result->rowCount();
        if($num_rows_result == 0)
        {
            echo "<script>window.open('404.php','_self')</script>";
        }
        return $result;
    }

}