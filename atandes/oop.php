<?php
session_start();
include_once "db.php";

class oop extends db
{
    //private $conn ;
    private $stmt ; 
    function __construct(){
        $this->dbconnect() ;
        //return $this->conn;
    }
    function insertclass($classname , $classteacher,$starttime,$endtime){
        $this->stmt = $this->conn->prepare("INSERT INTO `atendes_class`(`class_name`,`class_teacher`,`start_time`,`end_time`) VALUES (?,?,?,?)");
        $this->stmt->bind_param("ssss",$classname , $classteacher,$starttime,$endtime);
        $this->stmt->execute();
    }
    function insertuser($user , $inserttime,$id){
        $this->stmt = $this->conn->prepare("INSERT INTO `atendes_user`(`username`,`cart_code`,`class_id`) VALUES (?,?,?)");
        $this->stmt->bind_param("sii" , $user , $inserttime,$id);
        $this->stmt->execute();
    }
    function insertdate($user , $inserttime,$time,$status){
        $this->stmt = $this->conn->prepare("INSERT INTO `atendes_time`(`user_id`,`insert_time`,`time`,`status`) VALUES (?,?,?,?)");
        $this->stmt->bind_param("iiss" , $user , $inserttime,$time,$status);
        $this->stmt->execute();
    }
    function select($column,$database,$condition){
        $this->stmt=$this->conn->prepare("SELECT ".$column." FROM ".$database." WHERE ".$condition);
        $this->stmt->execute();
        return $this->stmt ;
    }
    function deletedata($database ,$condition){
        $this->stmt=$this->conn->prepare('DELETE FROM '.$database.' WHERE '.$condition);
        $this->stmt->execute();
    }
}
//;
?>