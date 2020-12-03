<?php
require_once("includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>پنل مدیریت </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">

  <!-- bootstrap rtl --> 

  <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

 <?php

    if(isset($_SESSION['login']))
    {
	require_once("layouts/nav.php");
    require_once("layouts/right_aside.php");

	?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<?php
	
	isset($_GET['get_cate']) ? require_once("categories/cate-index.php") : '';
	isset($_GET['insert_cate']) ? require_once("categories/cate-insert.php") : '';
	isset($_GET['id']) ? require_once("categories/cate-edit.php") : '';
	isset($_GET['delete']) ? require_once("categories/cate-index.php") : '';
	isset($_GET['get_post']) ? require_once("posts/posts_index.php") : '';
	isset($_GET['insert_post']) ? require_once("posts/posts_insert.php") : '';
	isset($_GET['edit_post']) ? require_once("posts/posts_edit.php") : '';
	isset($_GET['del_post']) ?  require_once("posts/posts_index.php") : '';
    isset($_GET['comment']) ? require_once("comments/comment_index.php") : '' ;
    isset($_GET['edit_comment']) ? require_once("comments/comment_edit.php") : '' ;
    isset($_GET['del_comment']) ? require_once("comments/comment_index.php") : '' ;
    if(isset($_GET['logout']))
    {
        logout();
        echo "<script>window.open('../login.php','_self')</script>";
    }
    ?>
	</div>
	</div>
	<?php
    require_once("layouts/footer.php");
    }
    else
    {
        echo "<script>alert('شما از مدیران سایت نیستید  ')</script>";
        echo "<script>window.open('../login.php','_self')</script>";

    }
    ?>

	

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="plugins/chartjs-old/Chart.min.js"></script>
	
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
	<script>
  $(function () {

    $('#posts_table').DataTable();
  });
</script>
</body>
</html>
