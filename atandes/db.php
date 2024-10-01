<?php

class db
{
    protected $localhost ;
    protected $username ;
    protected $password ;
    protected $database ;
    public $conn ;
    function dbconnect(){
        /*
        $this ->localhost ="localhost";
        $this ->username ="root";
        $this ->password="";
        $this ->database="atendes";
        */
        $this ->localhost ="server621.iseencloud.com";
        $this ->username ="jomjomco";
        $this ->password="W7#02YJpcAz1#v";
        $this ->database="jomjomco_kaiyi";
        
        $this ->conn = new mysqli($this->localhost,$this->username,$this->password,$this->database);
        return $this->conn ;
    }
}
?>