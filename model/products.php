<?php
class products
{
    public $database;
    public function  __construct(){
        $this->database= new PDO("mysql:host=localhost;dbname=super;","root","");
        
    }
     public function add($name,$price,$number,$catagory,$buy_price)
    {
        $addstat='insert into super.products (name,price,number,catagory,buy_price) values (:name,:price,:number,:catagory,:buy_price)';
        $add=$this->database->prepare($addstat);
        $add->bindparam("name",$name);
        $add->bindparam("price",$price);
        $add->bindparam("number",$number);
        $add->bindparam("catagory",$catagory);
        $add->bindparam("buy_price",$buy_price);
        $add->execute();
    }
    public function check($name)
    {
        $checkstat='select * from super.products where name=:name ';
        $check=$this->database->prepare($checkstat);
        $check->bindparam("name",$name);
        $check->execute();
        if($check->rowCount()>0) 
        {
            $check=$check->fetchObject();
            return $check;

        }
                          
        else
          return 0;


    }
    public function update($name,$price,$number,$catagory,$buy_price)
    {
        $updatestat="update super.products set price=:price ,number=:number+number,buy_price=:buy_price where name=:name";
        $update=$this->database->prepare($updatestat);
        $update->bindparam("name",$name);
        $update->bindparam("price",$price);
        $update->bindparam("number",$number);
        $update->bindparam("catagory",$catagory);
        $update->bindparam("buy_price",$buy_price);
        $update->execute();

    }
    public function get_id($name)
    {
       return $this->check($name)->id;

    }
    public function decrease($name,$number)
    {
        if(!$this->check($name)->id<=0)
        {
            $updatestat="update super.products set number=number-:number where name=:name";
            $update=$this->database->prepare($updatestat);
            $update->bindparam("name",$name);
            $update->bindparam("number",$number);
            $update->execute();

        }
       
        
    }
}