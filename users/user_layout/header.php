<?php
require_once '../admin/includes/functions.php';
$getcate=getCate(null,3);
?>
<style>
    ul{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }

    ul.dropdown{
        position: relative;
        width: 70%;
        border-radius: 20px;
    }

    ul.dropdown li{
        font-weight: bold;
        float: left;
        width: 120px;
        position: relative;
    }

    ul.dropdown a:hover{
        color: #fff;
    }

    ul.dropdown li a {
        display: block;
        padding: 20px 8px;
        color: cornsilk;
        position: relative;
        z-index: 2000;
        text-align: center;
        text-decoration: none;
        font-weight: 300;
    }

    ul.dropdown li a:hover,
    ul.dropdown li a.hover{
        background: #3498db;
        position: relative;
        color: #fff;
    }


    ul.dropdown ul{
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 180px;
        z-index: 1000;
    }

    ul.dropdown ul li {
        font-weight: normal;
        background: #f6f6f6;
        color: #fff;
        border-bottom: 1px solid #ccc;
    }

    ul.dropdown ul li a{
        display: block;
        color: #34495e !important;
        background: #eee !important;
    }

    ul.dropdown ul li a:hover{
        display: block;
        background: #3498db !important;
        color: #fff !important;
    }


</style>
<header class="rtl">
    <nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
        <a class="navbar-brand col-lg-1" href="index.php" ><img src="../images/logo.png" alt="logo" width="100" height="60"></a>

        <div class="collapse navbar-collapse col-lg-10 d-flex justify-content-around" id="navbarSupportedContent">

            <form class="form-inline flex-nowrap my-2 my-lg-0 col-lg-9" action="../result_search.php" method="get">
                <input class="form-control mr-sm-2 col-lg-10 " type="search" name="search" placeholder="جستجو ..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 ml-md-0 ml-3 mr-2" type="submit" >جستجو</button>
            </form>
            <ul class="d-flex justify-content-start">
                <li class="nav-item active text-light " style="list-style: none">
                    <a class="nav-link text-light" href="../register.php">ثبت نام <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active " style="list-style: none">
                    <a class="nav-link text-light" href="../login.php">ورود <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>

    </nav>
    <div style="width: 100%;height: 65px;" class="bg-dark d-flex justify-content-center">
        <ul class="dropdown mr-5 d-flex justify-content-center" >
            <li class="drop rounded">
                <a class="nav-link text-light" href="../index.php">صفحه اصلی</a>
            </li>
            <?php

            while ($row=mysqli_fetch_array($getcate))
            {
                ?>

                <li class="drop rounded">
                    <a class="nav-link text-light" href="../category_post.php?id_cate=<?= $row['id'] ?>"><?= $row['title'] ?></a>


            <?php

              echo '<ul class="sub_menu">';

            $catemenu=menuCate($row['id']);
            while($row_catemenu=mysqli_fetch_array($catemenu))
            {
                ?>
                <li><a href="#"><?= $row_catemenu['title']?></a></li>


                <?php

             }
            echo'</ul>
             </li>';
            }
            ?>

            <?php
            if($_SESSION['user_status'] == 0)
            {
                ?>
                <li class="drop rounded">
                    <a class="nav-link" href="index.php">حساب من <span class="sr-only">(current)</span></a>
                </li>
                <?php
            }
            else{

            ?>
            <?php
               ?>
                <li class="drop rounded">
                    <a class="nav-link" href="admin/dashboard.php">حساب من <span class="sr-only">(current)</span></a>
                </li>
            <?php
            }
            ?>
            <li class="drop rounded">
                <a class="nav-link" href="about.php">درباره ما <span class="sr-only">(current)</span></a>
            </li>
            <li class="drop rounded">
                <a class="nav-link" href="contact.php">تماس با ما <span class="sr-only">(current)</span></a>
            </li>

        </ul>
    </div>


</header>
