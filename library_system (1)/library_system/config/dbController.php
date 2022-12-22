
<?php
/*
Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose: This class dbControl is designed for building up the session
using the mysqli_connect() method*/

class dbControl{


    public $host="localhost";
    public $username="root";
    public $password="";
    public $databasename="db12";
    public $conn;

    //this is the main function thats leading for the connection formation
    function getdbSession(){
        $this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->databasename);
        if(!$this->conn){
         return false;}
        else{
        // echo 'build the conn';
        return $this->conn;
        }
    }

    //this function will destroy the connection 
    function destroySession(){
        if($this->conn)
         mysqli_close($this->conn);
    }
}
?>