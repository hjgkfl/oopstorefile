<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | صفحه ثبت نام</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="admin/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="admin/dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="admin/dist/css/custom-style.css">
</head>
<body class="hold-transition register-page">
<?php

  require_once("admin/includes/functions.php");


if(count($_POST) && isset($_POST['l_f_name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass_repeat']))
 {
     $error=[];
     $l_f_name=mysqli_real_escape_string($link,$_POST['l_f_name']);
     $email=mysqli_real_escape_string($link,$_POST['email']);
     $pass=mysqli_real_escape_string($link,$_POST['pass']);
     $pass_r=mysqli_real_escape_string($link,$_POST['pass_repeat']);

     empty($_POST['l_f_name']) ? array_push($error,"نام و نام خانوادگی خود را وارد نکردید") : '';

     if(empty($_POST['pass']))
        array_push($error,"رمز عبور خود را وارد نکردید");

     if(empty($_POST['pass_repeat']))
          array_push($error,"تکرار رمز عبور خود را وارد نکردید");

     if(empty($_POST['email']))
         array_push($error,"ایمیل خود را وارد نکردید");
     else
     {
         if(filter_var($email,FILTER_VALIDATE_EMAIL)==true)
         {

         }
         else
         {
             array_push($error,"ایمیل نادرستی وارد کردید !! امیل درستی وارد کنید ");

         }
     }

     if(!empty($_POST['pass']) && !empty($_POST['pass_repeat']))
     {
         if($_POST['pass'] != $_POST['pass_repeat'])
              array_push($error,"رمز عبور با تکرارش یکی نیست !");

         if((preg_match("/^(?=.*[A-z])(?=.*[0-9])$/",$_POST['pass'])))
            array_push($error,"رمز عبور  که وارد کردید صحیح نیست !  رمز عبور شما باید دارای حروف کوچک و بزرگ انگلیسی باشد  و باید دارای اعداد هم باشد");
     }
     if(count($error) == 0) {

         $run_s_r = storeRegister($l_f_name, $email, $pass);
         if ($run_s_r = true)
             $j=new taskvi();
             $j->taskCheck($email);
         }
     $c=count($error);
     echoError($error,$c);

 }
	

?>

<div class="register-box">
  <div class="register-logo">
      <b>ثبت نام در سایت </b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">ثبت نام کاربر جدید</p>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="l_f_name" placeholder="نام و نام خانوادگی">
          <div class="input-group-append">
            <span class="fa fa-user input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="ایمیل" >
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" placeholder="رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass_repeat" placeholder="تکرار رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> با <a href="#">شرایط</a> موافق هستم
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت نام</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="login.php" class="text-center">من قبلا ثبت نام کرده ام</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
    })
  })
</script>
</body>
</html>
