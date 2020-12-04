<?php

namespace users;

abstract class userPanel
{
    protected $name;
    protected $email;


    public function __construct()
    {

    }
    public function dbConnent()
    {
        $db = mysqli_connect("localhost", "root", "", "pars");
        mysqli_set_charset($db, 'UTF8');
        return $db;
    }

    abstract public function updateUser();
    abstract public function deleteUser($id);
    abstract public function selectUser($id);

}
class task_user extends userPanel
{
    public function updateUser()
    {
        $this->dbConnent();
       $sql="UPDATE users SET `l-f-name`='{$this->l_f_name}',`email`='{$this->email}',`password`='{$this->password}',
       `phone`='{$this->phone}',`National code`='{$this->National_Code}',`age`=$this->age";
        return $run=mysqli_query($this->dbConnent(),$sql);

    }
    public function deleteUser($id)
    {
        $this->dbConnent();
        $sql="DELETE FROM users where `id`=$id";
        return $run=mysqli_query($this->dbConnent(),$sql);
    }
    public function selectUser($id = null)
    {
        $this->dbConnent();
        $sql="SELECT * FROM users ";
        if(!is_null($id))
        {
            $sql .= " WHERE `id`=$id";
        }
        return $run=mysqli_query($this->dbConnent(),$sql);

    }
}
