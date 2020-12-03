<?php

use Classes\Comment;
use Classes\DB;

$db = new DB();
$comment = new Comment($db->conn);

if(count($_POST) && isset($_POST['description']) && !isset($_POST['parent_id']))
{
    $is_confirm=isset($_POST['is_confirm']) ? 1 : 0;
    $comment->updateComment($_POST['description'],$is_confirm,$_GET['edit_comment']);
}
if(isset($_POST['description']) && isset($_POST['parent_id']) && isset($_POST['post_id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
    $store=$comment->storeComment($_SESSION['name'],$_POST['description'],$_POST['post_id'],$_SESSION['email'],'',$_POST['parent_id']);
}
if(count($_GET) && isset($_GET['edit_comment']) && is_numeric($_GET['edit_comment']) || isset($_GET['reply']))
{
    $select_c=$comment->find($_GET['edit_comment']);
    $row=$select_c->fetch();
}

?>
<!-- Main content -->
<div class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">تغییر نظرات کاربران</h3>
                </div>
                        <form role="form" method="post" action="">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="description">نظر کاربر برای پست <?= $row['post_id']?></label>
                                    <textarea name="description" class="form-control" id="description" placeholder="توضیحات را وارد کنید"><?= $row['description'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="is_confirm">تایید شدن برای نمایش  </label>
                                    <input type="checkbox" name="is_confirm" class="mr-2" id="is_confirm" <?= $row['is_confirm'] ? 'checked' : ' '?>>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary col-6">ارسال</button>
                                </div>
                            </div>
                        </form>

            </div>
            <!--/.col (left) -->
            <!-- right column -->

            <!--/.col (right) -->
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</body>
</html>
