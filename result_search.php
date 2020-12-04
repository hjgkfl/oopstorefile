<?php

use Classes\DB;
use Classes\Post;

require_once 'config.php';

$db = new DB();
$post = new Post($db->conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فروشگاه</title>

    <link rel="stylesheet" href="admin/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="./style.css" />

</head>
<body>

<?php
require_once("front_layouts/header.php");
require_once("style.html");
?>

<main class="rtl mt-5 col-12">
    <div class="d-flex justify-content-center flex-wrap card-3d-all">

        <?php
        if(isset($_GET['search'])  && !empty($_GET['search']) )
        {
            $search=$post->searchPost($_GET['search']);
            while($row=$search->fetch())
            {

                ?>
                <div class="m-4 card card-3d"  style="width: 18rem;">
                    <div class="card-img ">
                        <img src="admin/posts/image-post/<?= !empty($row['pic_url']) ? $row['pic_url'] : 'p1.jpg'; ?>" class="card-img-top" alt="store">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="single.php" class="nav-link p-0 text-dark"><?= $row['title'] ?></a>
                        </h5>
                        <p class="card-text text-muted o-font-sm"><?= $row['short_description'] ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-around">
                        <i class="font-weight-bold text-success">25,000 تومان</i>
                        <i class="fa fa-low-vision fa-1x text-danger"><?= $row['count_views'] ?></i>
                        <i class="fa fa-check-circle-o fa-1x text-danger"><?= $row['count_views'] ?></i>
                    </div>
                    <div class="card-footer">
                        <a href="post.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-block">ادامه مطلب</a>
                    </div>
                </div>

                <?php
            
            }
        }
        ?>

    </div>
</main>


<?php require_once("front_layouts/footer.php"); ?>


<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./popper.min.js"></script>
<script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>
</body>
</html>

