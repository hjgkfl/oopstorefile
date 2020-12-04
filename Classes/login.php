<?php


namespace Classes;

session_start();

class login extends Model
{
    function loginCheck($email, $password)
    {
        $query = "SELECT * FROM `users` WHERE `email`='{$email}' AND `password`='{$password}' ";
        $result = $this->conn->query($query);
        $run = $result->fetch();
        $num_rows = $result->rowCount();
        if($num_rows == 1) {
            $t = $run['id'];
            $sql = "SELECT `user_status` FROM users WHERE `id`=$t ";
            $run1 = $this->conn->query($sql);
            $row = $run1->fetch();
            if ($row['user_status'] == self::Role_admin) {
                return [$_SESSION['login'] = 1, $_SESSION['user_status'] = $run['user_status'], $_SESSION['name'] = $run['l-f-name'], $_SESSION['email'] = $run['email'], header("location:admin/dashboard.php")];

            } else {
                return [$_SESSION['login'] = 1, $_SESSION['user_status'] = $run['user_status'], $_SESSION['name'] = $run['l-f-name'], $_SESSION['email'] = $run['email'], header("location:users/index.php")];

            }
        } else {
            echo "<script>alert('رمز عبور یا نام کاربری اشتباه است')</script>";
        }

    }
    function checkDate($email,$password)
    {
        $error=[];
        empty($email) ? array_push($error,"ایمیل خود را وارد  نکردید") : '';
        if(empty($password))
        {
            array_push($error,"رمز عبور خود را وارد  نکردید");
        }
        else
        {
            if((preg_match("/^(?=.*[A-z])(?=.*[0-9])$/",$password)))
                array_push($error,"رمز عبور  که وارد کردید صحیح نیست !  رمز عبور شما باید دارای حروف کوچک و بزرگ انگلیسی باشد و باید دارای اعداد هم باشد");
        }
        return $error;

    }
    function logout()
    {
        unset($_SESSION['login']);

    }

}
