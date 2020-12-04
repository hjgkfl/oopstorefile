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
}