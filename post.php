<?php

use Classes\Comment;
use Classes\DB;
use Classes\Post;

require_once 'config.php';

$db =new DB();

$post_obj = new Post($db->conn);

if((isset($_GET['id']) && $_GET['id'] != "" && is_numeric($_GET['id'])) || isset($_GET['page'])) {
    $post = $post_obj->find($_GET['id']);
    $post = $post->fetch();

    if($post == false) {
        header('Location: index.php');
        exit;
    }


    $post_obj->calculateCountViews($_GET['id']);

} else {
    header('Location: index.php');
    exit;
}

$comment_obj = new Comment($db->conn);

if(count($_POST) && isset($_POST['fname']) && isset($_POST['description']))
{
    if(empty($_POST['fname']))
    {
        echo errors(' نام خود را وارد نکردید');
    }
    else if(empty($_POST['description']))
    {
        echo errors('توضیحات خود را وارد نکردید');
    }
    else {
        $parent_id=isset($_POST['parent_id']) ? $_POST['parent_id'] : '0';
        $comment_obj->storeComment($_POST['fname'], $_POST['description'], $_POST['id_page'], $_POST['email'], $_POST['phone'] , $parent_id );
        echo "<script> alert('نظر شما ثبت شد پس از بررسی در سایت قرار خواهد گرفت')</script>";
    }
}
$comments = $comment_obj->getPostComment($post['id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مقاله انرژی های تجدید پذیر</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="admin/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-v4-rtl/dist/css/bootstrap-rtl.min.css.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<?php
require_once 'front_layouts/header.php';
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
                    $page_navi_c=$comment_obj->commentCount($_GET['page']);
                    $run_page=$comment_obj->pageNavi($_GET['id'],0,5,$page_navi_c);
                    $count_page=$run_page->rowCount();
                    if($count_page == 0)
                    {
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    while($row_page=$run_page->fetch())
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
                                    <input type="hidden" name="id_page" value="<?= $post['id']?>">

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
                        $parent_c=$comment_obj->getPostComment($post['id'],$row_page['id']);
                        if($parent_c == true)
                        {
                            while($comment_parent=$parent_c->fetch()) { ?>

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

                    $run_page=$comment_obj->getPostComment($post['id']);
                    $count_page=$run_page->rowCount();
                    if($count_page == 0)
                    {
                        echo "<b class='text-center text-danger '>نظری برای این پست وجود ندارد</b>";
                    }
                    ?>

                    <?php
                    $comment_list=$comment_obj->getPostComment($post['id'],0);
                    //comment all
                    while($run_is_C=$comment_list->fetch())
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
                            $parent_c=$comment_obj->getPostComment($post['id'],$run_is_C['id']);
                            if($parent_c == true)
                            {
                                while($comment_parent=$parent_c->fetch()) { ?>

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
                                    <input type="hidden" name="id_page" value="<?= $post['id']?>">
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
                $comment_l=$comment_obj->getPostComment($post['id'],null);
                $c=$comment_l->rowCount();
                ?>
                <div class="card-footer clearfix d-flex justify-content-center ">
                    <ul class="pagination pagination-sm m-0 float-right">

                        <?php
                       $id=$post['id'];
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
                                <a class="page-link bg-primary text-light" href="<?php $page=$i == 1 ? "post.php?id=$id" : "post.php?id=$id & page=$i" ; echo $page;  ?>"><?= $i?></a>
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
                <input type="hidden" name="id_page" value="<?= $post['id']?>">
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
</html>
