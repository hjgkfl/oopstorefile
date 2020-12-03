<?php

use Classes\DB;
use Classes\Post;

require_once 'config.php';

$db = new DB();

//var_dump($db->conn); die;

$post_obj = new Post($db->conn);
$posts = $post_obj->all();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>وبلاگ شی گرای پارسی طب</title>

    <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
<?php
require_once 'front_layouts/header.php'
?>
<main class="rtl mt-3">
    <div class="d-flex justify-content-center flex-wrap">
        <?php
        while ($post = $posts->fetch()) {
            require 'front_layouts/post_card.php';
        }
        ?>
    </div>
</main>

<?php
require_once 'front_layouts/footer.php'
?>


<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./popper.min.js"></script>
<script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>
</body>
</html>
