<?php

include 'users/userPanel.php';
interface imm
{
    public function sss();
}

trait taskCheckAdminAndUser
{
  public function taskCheck($email)
  {

      $db =new users\task_user();
      $db_c=$db->dbConnent();
      $sql="SELECT `user_status` FROM users WHERE `email`= $email ";
      $run=mysqli_query($db_c,$sql);
      if(mysqli_num_rows($run) == 0)
      {
          header("location:users/index.php");
          exit;
      }
      else
      {
          header("location:admin/dashboard.php");
          exit;
      }

  }
}
class taskvi
{
    use taskCheckAdminAndUser,taskCheckid;
}
trait taskCheckid
{
    public function taskCid($email)
    {
        $db =new users\task_user();
        $db_c=$db->dbConnent();
        $sql="SELECT `id` FROM users WHERE `email`= '{$email}' ";
        $run=mysqli_query($db_c,$sql);
        $row=mysqli_fetch_assoc($run);
        return $row['id'];

    }
}