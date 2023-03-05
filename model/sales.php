<?php
class sales
{
    public function __construct()
    {

        $this->mysql=new PDO("mysql:host=localhost;dbname=super;","root","");
        
    }
    public function add($number,$date,$product_id,$worker_name,$date_h)
    {
        $addstat='insert into super.sales (number,date,product_id,worker_name,date_h) values (:number,:date,:product_id,:worker_name,:date_h)';
        $add=$this->mysql->prepare($addstat);
        $add->bindparam("product_id",$product_id);
        $add->bindparam("number",$number);
        $add->bindparam("date",$date);
        $add->bindparam("date_h",$date_h);
        $add->bindparam("worker_name",$worker_name);
        $add->execute();

    }
    public function show($d)
    {
        $checkstat='SELECT products.name as product_name,products.number as product_number,SUM(sales.number) as number_of_sales ,
        SUM(sales.number)*(products.price-products.buy_price) as total_profits,SUM(sales.number)*(products.price) as TSM FROM sales JOIN products 
        ON sales.product_id=products.id WHERE sales.date>=:d GROUP BY sales.product_id';
        $check=$this->mysql->prepare($checkstat);
        $check->bindparam("d",$d);    
        $check->execute();
        $i=0; 
        foreach($check as $data)
        {
          $res[$i]=$data;
          $i++;
        }
        
        return $res;
        

    }
    public function lowest($d)
    {
        $checkstat='SELECT products.name as product_name
        FROM sales JOIN products 
        ON sales.product_id=products.id WHERE sales.date>=:d GROUP BY sales.product_id ORDER BY
         SUM(sales.number)*(products.price-products.buy_price) ASC LIMIT 1 ' ;
        $check=$this->mysql->prepare($checkstat);
        $check->bindparam("d",$d);  
        $check->execute();
        $check=$check->fetchObject();
        return $check->product_name;



    }
    public function most($d)
    {
        $checkstat='SELECT products.name as product_name
        FROM sales JOIN products 
        ON sales.product_id=products.id WHERE sales.date>=:d GROUP BY sales.product_id ORDER BY
         SUM(sales.number)*(products.price-products.buy_price) desc LIMIT 1 '  ;
        $check=$this->mysql->prepare($checkstat);
        $check->bindparam("d",$d);    
        $check->execute(); 
        $check=$check->fetchObject();
        return $check->product_name;



    }


    
}