<?php
class incoice
{
    public $database;
    public function  __construct(){
        $this->database= new PDO("mysql:host=localhost;dbname=super;","root","");
        
    }
     public function add($name,$price,$number,$total)
    {
        $addstat='insert into super.invoice (name,price,number,total) values (:name,:price,:number,:total)';
        $add=$this->database->prepare($addstat);
        $add->bindparam("name",$name);
        $add->bindparam("price",$price);
        $add->bindparam("number",$number);
        $add->bindparam("total",$total);
        $add->execute();
    }
    public function show()
    {
        $showstat='select * from super.invoice ';
        $show=$this->database->prepare($showstat);
        $show->execute();
        $i=0;
        foreach($show as $data)
        {
          $res[$i]=$data;
          $i++;
        }
        return $res;

    }
    public function delete()
    {
        $delstat="delete from invoice ";
        $del=$this->database->prepare($delstat);
        $del->execute();
    }
    public function total_price()
    {
        $showstat='select sum(total) as total_invoice from super.invoice ';
        $show=$this->database->prepare($showstat);
        $show->execute();
         $show=$show->fetchObject();
        return $show->total_invoice;

        
    }


}
