<?php
require_once("admin/includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فروشگاه</title>

    <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="./style.css" />
</head>
<body>

<?php
require_once("front_layouts/header.php");
if(count($_GET) && isset($_GET['id_cate']) && is_numeric($_GET['id_cate']))
{
    $get_cate_id = getPosts(null,$_GET['id_cate']);
    $num_rows=mysqli_num_rows($get_cate_id);
    if($num_rows == 0) {
        header('Location: 404.php');
        exit;
    }
}
else {
    header('Location: 404.php');
    exit;
}

?>

<main class="rtl mt-3 col-12">
    <div class="d-flex justify-content-center flex-wrap">
        <?php

        if(!isset($_POST['search']) && empty($_POST['search'])) {

        while($run_get_cate = mysqli_fetch_assoc($get_cate_id))
        {
            ?>
            <div class="card m-2 3d-card" style="width: 18rem;">

                <img src="admin/posts/image-post/<?= !empty($run_get_cate['pic_url']) ? $run_get_cate['pic_url'] : 'p1.jpg';
                ?>" class="card-img-top" alt="store">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="single.php" class="nav-link p-0 text-dark"><?= $run_get_cate['title'] ?></a>
                    </h5>
                    <p class="card-text text-muted o-font-sm"><?= $run_get_cate['short_description'] ?></p>
                </div>
                <div class="card-footer">
                    <p class="text-success text-center">25,000 تومان</p>
                    <a href="single.php?id=<?= $run_get_cate['id'] ?>" class="btn btn-outline-secondary btn-block">ادامه مطلب</a>
                </div>
            </div>

            <?php
            }
            }
        else{
                while ($run_search = mysqli_fetch_array($search)) {
                    require_once 'result_search.php';
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