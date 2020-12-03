<?php

if(count($_GET) && isset($_GET['del_post']) && is_numeric($_GET['del_post'])) {
    $result = deletePost($_GET['del_post']);
	  if($result)
		{
			 echo "<script>alert('پست مورد نظر شما حذف شد')</script>";
			 echo "<script>window.open('dashboard.php?get_post','_self')</script>";
		}
}

$posts = getPosts();



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
                  <th>عنوان</th>
                  <th>توضیح کوتاه</th>
                  <th>توضیح کامل</th>
                  <th>تاریخ</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($post = mysqli_fetch_assoc($posts)) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['short_description'] ?></td>
                            <td><?= mb_substr($post['description'], 0, 25) . ' ...' ?></td>
                            <td><?= $post['created_at'] ?></td>
                            <td class="d-flex justify-content-around">
                                <a href="dashboard.php?edit_post=<?= $post['id'] ?>" class="fa fa-edit fa-2x "></a> 
                                <a href="dashboard.php?del_post=<?= $post['id'] ?>" onclick="return confirm('Do you sure?');" class="fa fa-times fa-2x mr-1" style="color: red;"></a> 
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


</div>

</body>
</html>
