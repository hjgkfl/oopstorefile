<?php


namespace Classes;


class login extends Model
{
    function loginCheck($email, $password)
    {
        $query = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password' ";
        $result = $this->conn->query($query);
        $run = $result->fetch();
        if ($num_rows = $result->rowCount() == 1) {
            $t = $run['id'];
            $sql = "SELECT `user_status` FROM users WHERE `id`=$t ";
            $run1 = $this->conn->query($sql);
            $row = $run1->fetch();
            if ($row['user_status'] == 1) {
                return [$_SESSION['login'] = 1, $_SESSION['user_status'] = $run['user_status'], $_SESSION['name'] = $run['l-f-name'], $_SESSION['email'] = $run['email'], header("location:admin/dashboard.php")];

            } else {
                return [$_SESSION['login'] = 1, $_SESSION['user_status'] = $run['user_status'], $_SESSION['name'] = $run['l-f-name'], $_SESSION['email'] = $run['email'], header("location:users/index.php")];

            }
        } else {
            echo "<script>alert('رمز عبور یا نام کاربری اشتباه است')</script>";
        }

    }
    function echoError($error,$c)
    {
        for($i=0;$i<$c;$i++)
        {
            echo "<script>alert('$error[$i]')</script>";
        }
    }
}
