<?php
class sheft{
    private $mysql;
    public function __construct()
    {

        $this->mysql=new PDO("mysql:host=localhost;dbname=super;","root","");
        
    }
    public function add($start,$end,$name,$start_h,$end_h)
    {
        $addstat='insert into super.sheft_frame (start_time,end_time,worker_name,start_time_h,end_time_h) values (:start,:end,:name,:start_h,:end_h)';
        $add=$this->mysql->prepare($addstat);
        $add->bindparam("name",$name);
        $add->bindparam("start",$start);
        $add->bindparam("start_h",$start_h);
        $add->bindparam("end",$end);
        $add->bindparam("end_h",$end_h);
        $add->execute();

    }
    public function get_last_id()
    {
        $checkstat="select max(id) as max_id from super.sheft_frame ";
        $check=$this->mysql->prepare($checkstat);
        $check->execute();     
        $check=$check->fetchObject();
        return $check->max_id;
    }
    public function update_total_money($money)
    {
        $updatestat="update super.sheft_frame set total_money=total_money+:money  where id=:id";
        $update=$this->mysql->prepare($updatestat);
        $update->bindparam("money",$money);
        $id=$this->get_last_id();
        $update->bindparam("id",$id);
        $update->execute();
    }
    public function get_info($id){
        $getstat='select * from super.sheft_frame where id=:id ';
        $get=$this->mysql->prepare($getstat);
        $get->bindparam("id",$id);
        $get->execute();
        $get=$get->fetchObject();
        return $get;
    }
    public function update_end_date()
    {
        $updatestat="update super.sheft_frame set end_time=:end_time ,end_time_h=:ETH  where id=:id";
        $update=$this->mysql->prepare($updatestat);
        $t=date("Y-m-d");
        $t_h=date("H");
        $update->bindparam("end_time",$t);
        $update->bindparam("ETH",$t_h);

        $id=$this->get_last_id();
        $update->bindparam("id",$id);
        $update->execute();

    }
}