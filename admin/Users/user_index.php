<?php

use Classes\DB;
use Classes\User;

$db = new DB();
$get_users = new User($db->conn);

if(count($_GET) && isset($_GET['get_user']) && is_numeric($_GET['get_user'])) {
    $result = deletePost($_GET['del_post']);
    if($result)
    {
        echo "<script>alert('پست مورد نظر شما حذف شد')</script>";
        echo "<script>window.open('dashboard.php?get_post','_self')</script>";
    }
}


$users = $get_users->all();

?>

<!-- Main content -->
<div class="content">
    <div class="row">

        <div class="card col-12">
            <div class="card-header">
                <h3 class="card-title">Data Table With Full Features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="posts_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام و نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>شماره موبایل</th>
                        <th>کد ملی</th>
                        <th>سن</th>
                        <th>سطح دسترسی</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while ($user = $users->fetch()) {
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $user['l-f-name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td><?= $user['National Code'] ?></td>
                        <td><?= $user['age'] ?></td>
                        <td><?= $user['user_status'] == 1 ?  "مدیر سایت" : 'کاربر معمولی' ?></td>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!--/.col (right) -->
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>

</body>
</html>
