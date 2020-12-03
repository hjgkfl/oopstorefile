<?php

use Classes\Comment;
use Classes\DB;
use Classes\Post;

require_once 'config.php';

$db =new DB();

$post_obj = new Post($db->conn);

if(count($_GET) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post = $post_obj->find($_GET['id']);
    $post = $post->fetch();

    if(is_null($post)) {
        header('Location: index.php');
        exit;
    }

    $post_obj->calculateCountViews();
} else {
    header('Location: index.php');
    exit;
}

$comment_obj = new Comment($db->conn);

if(count($_POST)) {
    $comment_obj->store($_POST);
}

$comments = $comment_obj->getPostComment($post['id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $post['title'] ?></title>

    <link rel="stylesheet" href="./node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="./style.css" />
</head>
<body>
<?php
require_once 'front_layouts/header.php'
?>
<main class="rtl mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-5 d-flex d-md-block justify-content-center">
                <div class="d-flex justify-content-center single-img mb-4 ">
                    <img src="admin/posts/image-post/<?= $post['pic_url']?>" style="width:100%;height: 300px;" alt="file" >
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-7">
                <h1 class="o-font-md font-weight-bold"><?= $post['title'] ?></h1>
                کد مقاله:<span class="text-muted d-block mb-2"><?= $post['id']?></span>
                <strong>قیمت محصول: </strong><span class="d-block text-success">25,000 تومان</span>
            </div>
        </div>
        <hr>
        <article class="o-font-sm text-dark text-justify">
            <p><?= nl2br($post['description'],true) ?></p>

            <hr>
            <div class="post border-left border-right border-primary  rounded ">
                <h4 class="text-center text-dark border border-right-0 border-left-0  p-1 border-primary">نظرات کاربران (5)</h4>
                <?php

                if(count($_GET) && isset($_GET['page']) && is_numeric($_GET['page']))
                {
                    $page_navi_c=commentCount($_GET['page']);
                    $run_page=pageNavi($id,0,5,$page_navi_c);
                    $count_page=mysqli_num_rows($run_page);
                    if($count_page == 0)
                    {
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    while($row_page=mysqli_fetch_array($run_page))
                    {

                        ?>
                        <div class="col-12  rounded-top">
                            <div class="user-block bg-light mt-5 w-100 ">
                                <div class=" d-flex flex-column align-items-center rounded-right" style="width: 140px;height: 200px;float: right">
                                    <img class="card-img rounded-pill mt-2 mr-2" style="width: 80px ;height: 80px;border: 2px solid rgba(0,0,0,0.4)" src="images/1.jpg" alt="user image">
                                    <div class="widget-user-username text-center">
                                        <b class="description-text text-warning mt-1"><?= $row_page['name']?> </b><br>
                                        <b class="description-block mt-1" ><?= $row_page['created_at'] ?></b>
                                    </div>
                                </div>

                                <div class="rounded p-2 rounded-left" style="width: 600px;float: right">
                                    <p class="mt-2">
                                        <i class="fa fa-arrow-circle-left fa-1x text-warning"></i>
                                        <?= $row_page['description']?>

                                    </p>

                                </div>
                                <div class="mr-5 ml-5 d-flex justify-content-around " style="width: 200px;height:50px;float:right;margin-top: 70px;">
                                    <a href="#demo<?= $row_page['id']?>" class="btn btn-outline-warning w-50" data-toggle="collapse">پاسخ</a>
                                    <a href="#" class="btn btn-outline-danger w-50 ml-2 text-center" data-toggle="collapse">پسند</a>

                                </div>
                            </div>

                        </div>

                        <div class="container">
                            <div id="demo<?= $row_page['id']?>" class="collapse align-content-center">
                                <form action="" method="post" class="mt-3">
                                    <h4 class="text-warning">پاسخ به نظر : <?= $row_page['name'] ?></h4>
                                    <input type="hidden" name="parent_id" value="<?= $row_page['id']?>">
                                    <input type="hidden" name="id_page" value="<?= $_GET['id']?>">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputName4"><i class="text-danger">*</i> نام</label>
                                            <input type="text" class="form-control" name="fname" id="inputName4">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPhone4">شماره همراه</label>
                                            <input type="text" class="form-control" name="phone" id="inputPhone4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4"> ایمیل</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description"><i class="text-danger">*</i> توضیحات</label>
                                            <textarea class="form-control h-100"  name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-5 w-25">پاسخ دادن</button>
                                    <button type="button" class="btn btn-danger mt-5 mr-4 w-25">لغو پاسخ</button>

                                </form>

                            </div>
                        </div>
                        <?php

                        //comment-answer
                        $parent_c=getComment($_GET['id'],1,null,$row_page['id']);
                        if($parent_c == true)
                        {
                            while($comment_parent=mysqli_fetch_array($parent_c)) { ?>

                                <div class="user-block bg-dark d-flex justify-content-start mt-5 col-8 rounded" style="margin-right: 100px;">
                                    <div class=" d-flex flex-column align-items-center rounded-right " style="width: 140px;height: 200px;">
                                        <img class="card-img  rounded-pill mt-2" style="width: 80px ;height: 80px;border: 2px solid rgba(0,0,0,0.4)" src="images/4.jpg" alt="user image">
                                        <div class="widget-user-username text-center mr-1">
                                            <b class="description-text text-warning mt-1"><?= $comment_parent['name']?> </b><br>
                                            <b class="description-block mt-1" ><?= $comment_parent['created_at'] ?></b>
                                        </div>
                                    </div>
                                    <div class="rounded  p-2 rounded-left">
                                        <p class="mt-2">
                                            <i class="fa fa-arrow-circle-left fa-1x text-warning"></i>
                                            <?= $comment_parent['description']?>

                                        </p>
                                    </div>
                                </div>

                                <?php
                            }
                        }

                        ?>
                        <?php
                    }

                }


                else {

                    $run_page=getComment($_GET['id'],1,null);
                    $count_page=mysqli_num_rows($run_page);
                    if($count_page == 0)
                    {
                        echo "<b class='text-center text-danger '>نظری برای این پست وجود ندارد</b>";
                    }
                    ?>

                    <?php
                    $i=1;
                    //comment all
                    while($run_is_C=mysqli_fetch_array($comment_is_c))
                    {

                        ?>
                        <div class="col-12 bg-light-gradient rounded-top">
                            <div class="user-block bg-light mt-5 w-100 ">
                                <div class=" d-flex flex-column align-items-center rounded-right" style="width: 140px;height: 200px;float: right">
                                    <img class="card-img rounded-pill mt-2 mr-2" style="width: 80px ;height: 80px;border: 2px solid rgba(0,0,0,0.4)" src="images/1.jpg" alt="user image">
                                    <div class="widget-user-username text-center">
                                        <b class="description-text text-warning mt-1"><?= $run_is_C['name']?> </b><br>
                                        <b class="description-block mt-1" ><?= $run_is_C['created_at'] ?></b>
                                    </div>
                                </div>

                                <div class="rounded p-2 rounded-left" style="width: 600px;float: right">
                                    <p class="mt-2">
                                        <i class="fa fa-arrow-circle-left fa-1x text-warning"></i>
                                        <?= $run_is_C['description']?>

                                    </p>

                                </div>
                                <div class="mr-5 ml-5 d-flex justify-content-around " style="width: 200px;height:50px;float:right;margin-top: 70px;">
                                    <a href="#demo<?= $run_is_C['id']?>" class="btn btn-outline-warning w-50 btn_reply_cm" data-toggle="collapse">پاسخ</a>
                                    <a href="#" class="btn btn-outline-danger w-50 ml-2 text-center" data-toggle="collapse">پسند</a>

                                </div>
                            </div>


                            <?php
                            //comment-answer
                            $parent_c=getComment($_GET['id'],1,null,$run_is_C['id']);
                            if($parent_c == true)
                            {
                                while($comment_parent=mysqli_fetch_array($parent_c)) { ?>

                                    <div class="user-block bg-dark d-flex justify-content-start mt-5 col-8 rounded" style="margin-right: 100px;">
                                        <div class=" d-flex flex-column align-items-center rounded-right " style="width: 140px;height: 200px;">
                                            <img class="card-img  rounded-pill mt-2" style="width: 80px ;height: 80px;border: 2px solid rgba(0,0,0,0.4)" src="images/4.jpg" alt="user image">
                                            <div class="widget-user-username text-center mr-1">
                                                <b class="description-text text-warning mt-1"><?= $comment_parent['name']?> </b><br>
                                                <b class="description-block mt-1" ><?= $comment_parent['created_at'] ?></b>
                                            </div>
                                        </div>
                                        <div class="rounded  p-2 rounded-left">
                                            <p class="mt-2">
                                                <i class="fa fa-arrow-circle-left fa-1x text-warning"></i>
                                                <?= $comment_parent['description']?>

                                            </p>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }

                            ?>
                        </div>

                        <div class="container">
                            <div id="demo<?= $run_is_C['id']?>" class="collapse align-content-center" date-comment_id="<?= $run_is_C['id']?>">
                                <form action="" method="post" class="mt-3">
                                    <h4 class="text-warning">پاسخ به نظر : <?= $run_is_C['name'] ?></h4>
                                    <input type="hidden" name="parent_id" value="<?= $run_is_C['id'] ?>">
                                    <input type="hidden" name="id_page" value="<?= $_GET['id']?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputName4"><i class="text-danger">*</i> نام</label>
                                            <input type="text" class="form-control" name="fname" id="inputName4">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPhone4">شماره همراه</label>
                                            <input type="text" class="form-control" name="phone" id="inputPhone4">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4"> ایمیل</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description"><i class="text-danger">*</i> توضیحات</label>
                                            <textarea class="form-control h-100"  name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-5 w-25">پاسخ دادن</button>
                                    <button type="button" class="btn btn-danger mt-5 mr-4 w-25">لغو پاسخ</button>

                                </form>

                            </div>
                        </div>

                        <?php
                    }
                }
                ?>
                <?php
                $select=getComment($_GET['id'],1,null,0);
                $c=mysqli_num_rows($select);
                ?>
                <div class="card-footer clearfix d-flex justify-content-center ">
                    <ul class="pagination pagination-sm m-0 float-right">

                        <?php

                        $r=$c / 5;
                        if(is_float($r))
                        {
                            $r++;
                        }

                        for($i=1;$i<=$r;$i++)
                        {

                        ?>
                        <li class="page-item">

                            <?php for($k=$i;$k<=$i;$k++)
                            {
                                ?>
                                <a class="page-link bg-primary text-light" href="<?php $page=$i == 1 ? "single.php?id=$id" : "single.php?id=$id & page=$i" ; echo $page;  ?>"><?= $i?></a>
                                <?php
                            }
                            echo "</li>";

                            }

                            ?>
                    </ul>
                </div>
            </div>


            <h5 class="mb-3 mt-5">ثبت نظرات</h5>
            <form action="" method="post" data-toggle="collapse">
                <input type="hidden" name="id_page" value="<?= $_GET['id']?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputName4"><i class="text-danger">*</i> نام</label>
                        <input type="text" class="form-control" name="fname" id="inputName4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPhone4">شماره همراه</label>
                        <input type="text" class="form-control" name="phone" id="inputPhone4">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4"> ایمیل</label>
                        <input type="email" class="form-control" name="email" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description"><i class="text-danger">*</i> توضیحات</label>
                        <textarea class="form-control h-100"  name="description" id="description"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-5 w-25">ثبت نظر</button>
            </form>
        </article>
    </div>
</main>


<?php require_once("front_layouts/footer.php"); ?>
<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./popper.min.js"></script>
<script src="./node_modules/bootstrap-v4-rtl/dist/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $(".btn-danger").click(function(){
            $(".collapse").collapse('hide');

        });
        $(".btn-warning").click(function(){
            $(this).collapse('show');

        });


    });
</script>
</body>
</html></html>