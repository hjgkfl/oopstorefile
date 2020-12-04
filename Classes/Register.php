<?php


namespace Classes;


class Register extends Model
{

        function storeRegister($l_f_name,$email,$pass)
        {
            $query="INSERT INTO `users`(`l-f-name`,`email`,`password`) VALUES('{$l_f_name}','{$email}','{$pass}') ";
            $result = $this->conn->query($query);
            if($result = true )
            {
                $_SESSION['login']=1;
                $_SESSION['name']=$l_f_name;
                $_SESSION['email']=$email;
                $_SESSION['user_status']=self::Role_user;

            }
            return $result;
        }
        function checkDate($l_f_name,$email,$pass,$pass_repeat)
        {
            $error=[];
            $l_f_name_value=mysqli_real_escape_string($this->conn,$l_f_name);
            $email_value=mysqli_real_escape_string($this->conn,$email);
            $pass_value=mysqli_real_escape_string($this->conn,$pass);
            $pass_r_value=mysqli_real_escape_string($this->conn,$pass_repeat);

            empty($l_f_name_value) ? array_push($error,"نام و نام خانوادگی خود را وارد نکردید") : '';

            if(empty($pass_value))
                array_push($error,"رمز عبور خود را وارد نکردید");

            if(empty($pass_r_value))
                array_push($error,"تکرار رمز عبور خود را وارد نکردید");

            if(empty($email_value))
                array_push($error,"ایمیل خود را وارد نکردید");
            else
            {
                if(filter_var($email_value,FILTER_VALIDATE_EMAIL)==true)
                {
                      echo "";
                }
                else
                {
                    array_push($error,"ایمیل نادرستی وارد کردید !! امیل درستی وارد کنید ");

                }
            }

            if(!empty($pass_value) && !empty($pass_r_value))
            {
                if($pass_value != $pass_r_value)
                    array_push($error,"رمز عبور با تکرارش یکی نیست !");

                if((preg_match("/^(?=.*[A-z])(?=.*[0-9])$/",$pass_value)))
                    array_push($error,"رمز عبور  که وارد کردید صحیح نیست !  رمز عبور شما باید دارای حروف کوچک و بزرگ انگلیسی باشد  و باید دارای اعداد هم باشد");
            }
         return $error;
        }
}