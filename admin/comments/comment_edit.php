<?php

if(count($_POST) && isset($_POST['description']) && !isset($_POST['parent_id']))
{
    $is_confirm=isset($_POST['is_confirm']) ? 1 : 0;
    updateComment($_POST['description'],$is_confirm,$_GET['edit_comment']);
}
if(isset($_POST['description']) && isset($_POST['parent_id']) && isset($_POST['post_id']) && isset($_SESSION['email']) && isset($_SESSION['name']))
{
    $store=storeComment($_SESSION['name'],$_POST['description'],$_POST['post_id'],$_SESSION['email'],'',$_POST['parent_id']);
}
if(count($_GET) && isset($_GET['edit_comment']) && is_numeric($_GET['edit_comment']) || isset($_GET['reply']))
{
    $id=$_GET['edit_comment'];
    $select_c=getComment($_GET['edit_comment'],null);
    $row=mysqli_fetch_array($select_c);
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
                <!-- /.card-header -->
                <!-- form start -->
                <?php if(isset($_GET['reply'])){ ?>
                <form role="form" method="post" action="">
                    <input type="hidden" name="parent_id" value="<?= $row['id'] ?>" />
                    <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>" />
                    <div class="card-body">
                        <div class="form-group">
                            <label for="description" >نظر کاربر برای پست <?= $row['post_id']?></label>
                            <textarea name="description" disabled class="form-control" id="description" placeholder="توضیحات را وارد کنید"><?= $row['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="is_confirm">تایید شدن برای نمایش  </label>
                            <input type="checkbox" disabled name="is_confirm" class="mr-2" id="is_confirm" <?= $row['is_confirm'] ? 'checked' : ' '?>>
                        </div>

                        <div class="form-group mt-4">
                            <label for="description" class="mr-1">پاسخ به نظر آقا / خانم : <?= $row['name'] ?></label>
                            <textarea name="description" class="form-control" id="description" placeholder="توضیحات را وارد کنید"></textarea>
                        </div>

                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary col-6">ذخیره پاسخ </button>
                        </div>
                    </div>
                </form>
                        <?php
                        }
                        else{
                        ?>
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
                                <?php
                                }
                                ?>


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
