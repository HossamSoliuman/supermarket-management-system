<?php
class user 
{
    public $database;
    public function  __construct(){
        $this->database= new PDO("mysql:host=localhost;dbname=super;","root","");
        
    }
     public function add($name,$password,$role)
    {
        $addstat='insert into super.users (user_name,password,role) values (:name,:password,:role)';
        $add=$this->database->prepare($addstat);
        $add->bindparam("name",$name);
        $add->bindparam("password",$password);
        $add->bindparam("role",$role);
        $add->execute();
    }
    public function check($name,$password)
    {
        $checkstat='select * from super.users where user_name=:name and password=:password';
        $check=$this->database->prepare($checkstat);
        $check->bindparam("name",$name);
        $check->bindparam("password",$password);
        $check->execute();
        if($check->rowCount()>0) 
          return 1;                 
        else
          return 0;

    }
    public function ismanager($name)
    {
        $checkstat='select * from super.users where user_name=:name';
        $check=$this->database->prepare($checkstat);
        $check->bindparam("name",$name);
        $check->execute();
        $check=$check->fetchObject();
        if($check->role=="manager")
            return 1;
        else
            return 0;
    }
}