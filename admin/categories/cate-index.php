<?php
use Classes\categories;
use Classes\DB;

$db= new DB();
$categories_get =  new categories($db->conn);

if(isset($_GET['delete']) && is_numeric($_GET['delete']))
{
    $delete_c=$categories_get->deleteCate($_GET['delete']);
    if($delete_c)
    {
        echo "<script>alert('فیلد مورد نظر حذف شد')</script>";
        echo "<script>window.open('dashboard.php?get_cate','_self')</script>";

    }
}

$cate=$categories_get->all();

?>

<!-- Main content -->
<div class="content ">
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
                        <th>عنوان</th>
                        <th>نمایش صفحه اصلی </th>
                        <th>تاریخ</th>
                        <th>توضیح</th>
                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $c=1;
                    while($row=$cate->fetch())
                    {

                        ?>
                        <tr>

                            <td><?= $c++; ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['show_at_index'] ? 'بله':'خیر'?></td>
                            <td><?= $row['create_at']?> </td>
                            <td><?= $row['comment']?> </td>
                            <td class="d-flex justify-content-center"><a href="dashboard.php?id=<?= $row['id'] ?>" class="fa fa-edit fa-2x " data-toggle="tooltip" data-placement="top" title="ویرایش"></a>
                                <a href="dashboard.php?delete=<?= $row['id'] ?>" onClick="return confirm('آیا مطمئنی برای حذف ?')" class="fa fa-close fa-2x mr-2 text-danger" data-toggle="tooltip" data-placement="top" title="حذف"></a> </td>

                        </tr>
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
    <!-- /.content -->
</div>

</body>
</html>
