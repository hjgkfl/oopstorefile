<?php
use Classes\DB;
use Classes\Post;

require_once 'config.php';

$db =new DB();
$post_obj = new Post($db->conn);

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

if(count($_GET) && isset($_GET['id_cate']) && is_numeric($_GET['id_cate']))
{
    $get_cate_id = $post_obj->findCatePost($_GET['id_cate']);
    $num_rows=$get_cate_id->rowCount();
    if($num_rows == 0) {
        echo "<script>window.open('404.php','_self')</script>";
        exit;
    }
}
else {
    echo "<script>window.open('404.php','_self')</script>";
    exit;
}

?>

<main class="rtl mt-3 col-12">
    <div class="d-flex justify-content-center flex-wrap card-3d-all">
        <?php
        while($run_get_cate = $get_cate_id->fetch())
        {
            ?>
            <div class="card m-2 card-3d" style="width: 18rem;">

                <img src="admin/posts/image-post/<?= !empty($run_get_cate['pic_url']) ? $run_get_cate['pic_url'] : 'p1.jpg';
                ?>" class="card-img-top" alt="store">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="single.php" class="nav-link p-0 text-dark"><?= $run_get_cate['title'] ?></a>
                    </h5>
                    <p class="card-text text-muted o-font-sm"><?= $run_get_cate['short_description'] ?></p>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <i class="font-weight-bold text-success">25,000 تومان</i>
                    <i class="fa fa-low-vision fa-1x text-danger"><?= $run_get_cate['count_views'] ?></i>
                    <i class="fa fa-check-circle-o fa-1x text-danger"><?= $run_get_cate['count_views'] ?></i>
                </div>
                <div class="card-footer">
                    <p class="text-success text-center">25,000 تومان</p>
                    <a href="post.php?id=<?= $run_get_cate['id'] ?>" class="btn btn-outline-secondary btn-block">ادامه مطلب</a>
                </div>
            </div>

            <?php
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