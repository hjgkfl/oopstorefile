<?php


if(count($_POST) && isset($_POST['title']) && isset($_POST['comment']) && isset($_POST['parent_id']))
{
    $title=$_POST['title'];
    if(!isset($_POST['show_at_index']))
      $show_index='0';
    else
      $show_index=$_POST['show_at_index'];

     $parent_id=$_POST['parent_id'];
	 $comment=$_POST['comment'];
	 $insert_true=insertCate($title,$show_index,$comment,$parent_id);
	if($insert_true)
		 	 echo "<script>alert('دسته شما اضافه شد')</script>";
	
}

$getcate=getCate();
?>

    <div class="content">
    <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">درج دسته بندی جدید</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="">
                <div class="card-body">
                  <div class="form-group col-6">
                    <label for="title">عنوان دسته بندی </label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="عنوان دسته بندی را وارد کنید">
                  </div>
                 
                   <div class="form-group">
                    <label for="description">توضیحات </label>
                    <textarea name="comment" style="width: 630px;height: 100px;" class="form-control" id="description" placeholder="توضیحات در مورد دسته جدید  وارد کنید"></textarea>
                  </div>

                    <div class="form-group">
                        <label for="description">دسته مادر </label>
                        <select name="parent_id" class="form-control" id="description">
                            <option value='0'>انتخاب كنيد</option>

                            <?php
                            while($row=mysqli_fetch_array($getcate))
                            {
                            ?>
                                <option value='<?= $row['id']?>'><?= $row['title']?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                    <label for="show_at_index">نمایش در صفحه اصلی</label>
                    <input type="checkbox" name="show_at_index" value="1" class="mr-2" id="show_at_index">
                    </div>
                <div class="card-footer d-flex justify-content-center">
                  <button type="submit " class="btn btn-danger col-6">ارسال</button>
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
		</div>		
		
    <!-- /.content -->
	

</body>
</html>
