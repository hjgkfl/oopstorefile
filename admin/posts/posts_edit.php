<?php

if(count($_POST) && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['short_description'])  && isset($_POST['description']) && !empty($_POST['select_cate'])) {
  updatePost($_POST['id'], $_POST['title'], $_POST['short_description'], $_POST['description'],$_POST['select_cate']);
  		 
}

if(count($_GET) && isset($_GET['edit_post']) && is_numeric($_GET['edit_post'])) {
  $result = getPosts($_GET['edit_post']);
  $post = mysqli_fetch_assoc($result);
}

$category = getCate();
?>
    <!-- Main content -->
    <div class="content">
    <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">تغییر اطلاعات پست</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="">
                <input type="hidden" name="id" value="<?= $post['id'] ?>" />
                <div class="card-body">
                <div class="form-group">
                    <label>انتخاب دسته بندی برای پست</label>
                    <select class="form-control" name="select_cate">
                      <option >انتخاب کنید</option>
                      <?php while($row=mysqli_fetch_assoc($category)) { ?>
                      <option value="<?= $row['id'] ?>" <?= $row['id'] == $post['categories_id'] ? 'selected' : '' ?>><?= $row['title'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">عنوان پست</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="عنوان پست را وارد کنید" value="<?= $post['title'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">توضیحات کوتاه</label>
                    <input type="text" name="short_description" class="form-control" id="exampleInputPassword1" placeholder="توضیحات کوتاه را وارد کنید" value="<?= $post['short_description'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">توضیحات </label>
                    <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="توضیحات را وارد کنید"><?= $post['description'] ?></textarea>
                  </div>
                
                <div class="form-group">
                <label for="exampleInputFile">ارسال فایل</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                </div>
            
                <!-- /.card-body -->

                <div class="card-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-primary col-6">ارسال</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- /.card -->

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
