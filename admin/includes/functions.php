<?php
require_once 'db.php';
session_start();

function storePost($title,$short_description,$description,$file,$select_cate)
{
    global $link;
    $extension = explode('.', $file);
    $extension = end($extension);
    $file_name = time() . '.' . $extension;
    $upload = "posts/image-post/'.'$file_name";
    !is_dir("posts/image-post") ? mkdir("image-post") : '';
    if(move_uploaded_file($_FILES['file']['tmp_name'], $upload) == true) {
        $query = "INSERT INTO `posts`(`id`,`categories_id`, `title`, `short_description`, `description`, `count_views`, `pic_url`, `created_at`) VALUES
      (NULL,'{$select_cate}', '{$title}', '{$short_description}', '{$description}', '0', '$file_name', '" . date('Y-m-d H:i:s') . "')";

        $result = mysqli_query($link, $query);
    }
    else
    {
        echo "<script>alert('آپبود فایل درست انجام نشد')</script>";
    }
    return $result;
}
function updatePost($id, $title, $short_description, $description,$select_cate) {
    global $link;
    $query = "UPDATE `posts` SET 
        `categories_id` = '{$select_cate}',
        `title` = '{$title}', 
        `short_description` = '{$short_description}',
        `description` = '{$description}'
         WHERE `id` = '{$id}'";

    $result = mysqli_query($link, $query);
}
function updateCate($id, $title,$show_at_index,$comment,$parent_id) {
    global $link;
    $query = "UPDATE `categories` SET 
        `title` = '{$title}', 
	    `show_at_index` = '{$show_at_index}',
        `comment` = '{$comment}',
        `parent_id`= $parent_id
         WHERE `id` = '{$id}'";

    $result = mysqli_query($link, $query);
}

function getPosts($post_id = null,$cate_id = null) {

    global $link;
    $query = "SELECT * FROM `posts`";
    if(!is_null($post_id)) {
        $query .= " WHERE `id`='{$post_id}'";
    }
    if(!is_null($cate_id))
    {
        $query = " SELECT P.`title`,P.`categories_id`,P.`pic_url`,P.`id`,P.`short_description`,P.`description`,C.`id` AS `c_id`
    FROM `posts` 
    AS P JOIN `categories` AS C ON P.`categories_id` = C.`id` WHERE C.`id`=$cate_id";
    }
    $result = mysqli_query($link, $query);
    return $result;
}
function deletePost($post_id) {
    global $link;

    $query = "DELETE FROM `posts` WHERE `id`='{$post_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
function deleteCate($cate_id) {

    global $link;

    $query = "DELETE FROM `categories` WHERE `id`='{$cate_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
//categories
function getCate($cate_id = null,$limit = null ,$parent_id =null)
{
    global $link;
    $query = "SELECT * FROM `categories`";
    if(!is_null($cate_id)) {
        $query .= " WHERE `id`='{$cate_id}'";
    }
    if(!is_null($limit))
    {
        $query .= " LIMIT $limit ";
    }
    if(!is_null($parent_id))
    {
        $query .= " WHERE `parent_id`='{$parent_id}' ";
    }
    $result= mysqli_query($link,$query);
    return $result;
}
function menuCate($parent_id)
{
    global $link;
    $query="SELECT * FROM categories WHERE `parent_id`='{$parent_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
function insertCate($title,$show_at_index,$comment,$parent_id)
{
    global $link;
    $q="INSERT INTO categories(parent_id,title,show_at_index,create_at,comment) values('{$parent_id}','{$title}','{$show_at_index}','".date('Y-m-d H:i:s')."','$comment')";
    $result=mysqli_query($link,$q);

    return $result;
}

function storeComment($name_comment,$description_comment,$post_id,$email,$phone,$parent_id)
{
    global $link;
    $query = "INSERT INTO `comments` (`post_id`,`parent_id`,`name`,`mobile`,`email`,`description`,`created_at`) VALUES('{$post_id}','{$parent_id}','{$name_comment}','{$phone}','{$email}','{$description_comment}','" . date('Y-m-d H:i:s') . "')";
    $result = mysqli_query($link, $query);
    return $result;
}
function getComment($comment_id = null,$is_confirm = null,$limit = null,$parent_id = null)
{
    global $link;
    $query="SELECT * FROM `comments`";
    if(!is_null($comment_id) && !is_null($is_confirm) && !is_null($limit) && is_null($parent_id))
    {
        $query .= " WHERE `post_id`=$comment_id AND `is_confirm`= $is_confirm  LIMIT $limit";
    }
    if(!is_null($comment_id) && is_null($is_confirm) && is_null($limit) && is_null($parent_id)) {
        $query .= " WHERE  `id`= $comment_id " ;
    }
    if(!is_null($comment_id) && !is_null($is_confirm) && is_null($limit) && is_null($parent_id)) {
        $query .= " WHERE  `post_id`= $comment_id AND `is_confirm`= $is_confirm ";
    }
    if(!is_null($comment_id) && !is_null($is_confirm) && is_null($limit) && !is_null($parent_id)) {
        $query .= " WHERE  `post_id`=$comment_id AND `is_confirm`=$is_confirm  AND `parent_id`=$parent_id";
//        SELECT * from `comments` AS c JOIN `comments` AS c1 on c.`parent_id`=c1.`id` WHERE c.`parent_id` IN(13,17)

    }
    if(!is_null($comment_id) && !is_null($is_confirm) && !is_null($limit) && !is_null($parent_id)) {
        $query .= " WHERE  `post_id`=$comment_id AND `is_confirm`=$is_confirm  AND `parent_id`=$parent_id LIMIT $limit ";
    }

    $result=mysqli_query($link,$query);
    return $result;
}
function updateComment($description,$is_confirm,$id) {
    global $link;
    $query = "UPDATE `comments` SET 
        `description` = '{$description}',
        `is_confirm` = '{$is_confirm}'
         WHERE `id` = '{$id}'";

    $result = mysqli_query($link, $query);
    return $result;
}
function deleteComment($comment_id) {

    global $link;
    $query = "DELETE FROM `comments` WHERE `id`='{$comment_id}'";
    $result = mysqli_query($link, $query);
    return $result;
}
function echoError($error,$c)
{
    for($i=0;$i<$c;$i++)
    {
        echo "<script>alert('$error[$i]')</script>";
    }
}
function errors($error_info = null)
{
    $errno=[];
    if(!is_null($error_info))
    {
        array_push($errno, "$error_info");

    }
    $e=$errno[0];
    return "<script>alert('$e')</script>";
}


function calculateCountViews($post_id) {

    global $link;
    $viewed_pages = [];
    if(isset($_COOKIE['viewed_pages'])) {
        $viewed_pages = json_decode($_COOKIE['viewed_pages'], true);
    }
    if(!in_array($post_id, $viewed_pages)) {

        $query = "UPDATE `posts` SET 
        `count_views` = `count_views` + 1
         WHERE `id` = '{$post_id}'";

        $result = mysqli_query($link, $query);
        $viewed_pages[] = $post_id;
        setcookie('viewed_pages', json_encode($viewed_pages), time() + 3 * 24 * 3600);
    }

}

function getPostsForIndex( $limit = null, $orderBy = null, $orderType = 'ASC') {
    global $link;

    $query = "SELECT P.* FROM `posts` AS P JOIN `categories` AS C  ON P.`categories_id`=C.`id`  WHERE C.`show_at_index` = 1";


    if(!is_null($orderBy)) {
        $query .= " ORDER BY `" . $orderBy . "` " . $orderType;
    }
    if(!is_null($limit)){
        $query .= " LIMIT " . $limit;
    }
    $result = mysqli_query($link, $query);
    return $result;
}
//register_users
function storeRegister($l_f_name,$email,$pass)
{
    global $link;
    $query="INSERT INTO `users`(`l-f-name`,`email`,`password`) VALUES('{$l_f_name}','{$email}','{$pass}') ";
    $result=mysqli_query($link,$query);
    if($result = true )
    {
        $_SESSION['login']=1;
        $_SESSION['name']=$l_f_name;
        $_SESSION['email']=$email;

    }
    return $result;
}
function login($email,$password,$Reminder)
{
    global $link;
    $query="SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' ";
    $result=mysqli_query($link,$query);
    $run=mysqli_fetch_array($result);
    if($num_rows=mysqli_num_rows($result) == 1)
    {

        return [$_SESSION['login']=1,$_SESSION['name']=$run['l-f-name'],$_SESSION['email']=$run['email'],header("location:admin/dashboard.php")];

    }
    else
    {
        echo  "<script>alert('رمز عبور یا نام کاربری اشتباه است')</script>";
    }
}
function logout()
{
    unset($_SESSION['login']);

}
// صفحه بندی کامنت ها
function pageNavi($post_id,$parent_id,$limit,$offset)
{
    global $link;
    $query = "SELECT * FROM `comments` WHERE `post_id`=$post_id AND `is_confirm`= 1  AND `parent_id`=$parent_id  LIMIT  $limit OFFSET $offset ";
    $result=mysqli_query($link,$query);
    return $result;

}
function commentCount($page)
{
    $c=($page - 1) * 5;
    return $c;
}
function searchPost($search)
{
    global $link;
    $query = "SELECT * FROM `posts` WHERE `post_keywords` LIKE  '%$search%' ";
    $result=mysqli_query($link,$query);
    $num_rows_result=mysqli_num_rows($result);
    $result=$num_rows_result == 0 ?  header('location:404.php') : $result;
    return $result;
}



