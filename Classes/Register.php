<?php


namespace Classes;
session_start();

class Register extends Model
{

        function storeRegister($l_f_name,$email,$pass)
        {
            $query="INSERT INTO `users`(`l-f-name`,`email`,`password`) VALUES('{$l_f_name}','{$email}','{$pass}') ";
            $result = $this->conn->query($query);
            if($result == true )
            {
                return [$_SESSION['login']=1,$_SESSION['name']=$l_f_name,$_SESSION['email']=$email,$_SESSION['user_status']=self::Role_user];
            }
        }
        function checkDate($l_f_name,$email,$pass,$pass_repeat)
        {
            $error=[];
            empty($l_f_name) ? array_push($error,"نام و نام خانوادگی خود را وارد نکردید") : ' ';
            empty($pass) ? array_push($error,"رمز عبور خود را وارد نکردید") : ' ';
            empty($pass) ? array_push($error,"تکرار رمز عبور خود را وارد نکردید") : ' ';

            if(empty($email)) {
                array_push($error, "ایمیل خود را وارد نکردید");
            }
            else
            {
                if(filter_var($email,FILTER_VALIDATE_EMAIL) == true)
                {

                }
                else
                {
                    array_push($error,"ایمیل نادرستی وارد کردید !! امیل درستی وارد کنید ");

                }
            }

            if(!empty($pass) && !empty($pass_repeat))
            {
                if($pass != $pass_repeat)
                    array_push($error,"رمز عبور با تکرارش یکی نیست !");

                if((preg_match("/^(?=.*[A-z])(?=.*[0-9])$/",$pass)))
                    array_push($error,"رمز عبور  که وارد کردید صحیح نیست !  رمز عبور شما باید دارای حروف کوچک و بزرگ انگلیسی باشد  و باید دارای اعداد هم باشد");
            }
         return $error;
        }
}