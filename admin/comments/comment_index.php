<?php
if(count($_GET) && isset($_GET['del_comment']) && is_numeric($_GET['del_comment']))
{
    $delete_c=deleteComment($_GET['del_comment']);
}
$comment=getComment();
?>

        <div class="content">
            <div class="row">

                <div class="card col-12">
                    <div class="card-header">
                        <h3 class="card-title">لیست نظرات ثبت شده </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="posts_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>پست</th>
                                <th>نام</th>
                                <th>شماره همراه</th>
                                <th>تایید شده</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($com = mysqli_fetch_array($comment)) {
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><a href="../single.php?id=<?= $com['post_id'] ?>"> <?= $com['post_id'] ?></a></td>
                                <td><?= $com['name'] ?></td>
                                <td><?= $com['mobile'] ? $com['mobile'] : 'ندارد' ?></td>
                                <td><?= $com['is_confirm'] ? 'بله' : 'خیر' ?></td>
                                <td><?= $com['created_at'] ?></td>
                                <td class="d-flex justify-content-around">
                                    <a href="dashboard.php?edit_comment=<?= $com['id'] ?>" class="fa fa-edit fa-2x" data-toggle="tooltip" data-placement="top" title="ویرایش"></a>
                                    <a href="dashboard.php?edit_comment=<?= $com['id'] ?> & reply=1" class="fa fa-reply-all fa-2x " data-toggle="tooltip" data-placement="top" title="پاسخ"></a>
                                    <a href="dashboard.php?del_comment=<?= $com['id'] ?>" onclick="return confirm('آیا می خواهید این کامنت را حذف کنید?');" class="fa fa-times fa-2x mr-1" style="color: red;" data-toggle="tooltip" data-placement="top" title="حذف"></a>
                                </td>
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
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
