
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | پروفایل کاربری</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/45.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">



</head>
<body class="hold-transition sidebar-mini" dir="rtl">

<?php

use Classes\DB;
use Classes\User;

require_once '../config.php';

$db = new DB();
$User = new User($db->conn);

require_once 'user_layout/header.php';

if (isset($_SESSION['login'])) {

    $userget = $User->userGet($_SESSION['name']);
    $list_User=$userget->fetch();
}

?>
<div class="container-fluid bg-dark d-flex justify-content-start">

    <div class="card card-primary card-outline col-3 mt-4 rounded-lg border-left-0 border-right-0 " style="border: 3px solid rgba(211,200,100,0.7);">

    <div class="card-body box-profile">
        <div class="text-center ">
            <img class="profile-user-img rounded rounded-circle anim-b" width="140" height="140"
                 src="image/1.jpg"
                 alt="User profile picture">
        </div>

        <h4 class="text-dark text-center mt-1"><?= $_SESSION['name']  ?></h4>

         <div class="card-body  d-flex flex-column justify-content-start mt-4 col-xl-12">
                 <li class=" col-xl-12 d-flex justify-content-around " style="list-style: none">
                     <i class="fa fa-edit fa-2x text-break text-center col-lg-3 "></i>
                     <button type="button" class="btn btn-primary col-xl-11" name="edit">ویرایش اطلاعات</button>
                 </li>
             <li class=" col-xl-12 d-flex justify-content-around  mt-1" style="list-style: none">
                 <i class="fa fa-user fa-2x text-break text-center col-lg-3 "></i>
                 <button type="button" class="btn btn-primary col-xl-11" name="edit">اطلاعات حساب </button>
             </li>
             <li class=" col-xl-12 d-flex justify-content-around mt-1" style="list-style: none">
                 <i class="fa fa-comment fa-2x text-break text-center col-lg-3 "></i>
                 <button type="button" class="btn btn-primary col-xl-11" name="edit">آخرین دیدگاه ها</button>
             </li>
             <li class=" col-xl-12 d-flex justify-content-around mt-1" style="list-style: none">
                 <i class="fa fa-compass fa-2x text-break text-center col-lg-3 "></i>
                 <button type="button" class="btn btn-primary col-xl-11" name="edit">سفارش های من</button>
             </li>

         </div>


    </div>

    </div>
    <div class="container-lg bg-light mt-4 mr-2 col-9 rounded">
        <h4 class="text-right f-ashkan-lg mt-4"> اطلاعات شخصی</h4>
        <div class="mt-4 date-user">

        <div class="card  col-xl-6 float-right">
            <div class="card-body  d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>نام و نام خانوداگی :</span>
                    <?= $list_User['l-f-name']?>
                </p>
            </div>

        </div>
        <div class="card  col-xl-6 float-right">
            <div class="card-body  d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>شماره تلفن :</span>
                    <?= $list_User['phone']?>
                </p>
            </div>

        </div>
        <div class="card  col-xl-6 float-right">
            <div class="card-body d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>ایمیل :</span>
                    <?= $list_User['email']?>

                </p>
            </div>

        </div>
        <div class="card  col-xl-6 float-right">
            <div class="card-body  d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>سن :</span>
                    <?= $list_User['age']?>

                </p>
            </div>

        </div>
        <div class="card  col-xl-6 float-right">
            <div class="card-body  d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>کد ملی :</span>
                    <?= $list_User['National Code']?>
                </p>
            </div>

        </div>
        <div class="card  col-xl-6 float-right ">
            <div class="card-body  d-flex justify-content-start">
                <p class="f-ashkan">
                    <span>رمز عبور :</span>
                    <?= $list_User['password']?>
                </p>
            </div>

        </div>

    </div>
        <div class="rounded mt-5 bg-secondary" style="width: 100%;height: 600px;">


        </div>
    </div>
</div>


<?php
require_once 'user_layout/footer.php';

?>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
