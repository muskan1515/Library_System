<?php

class models{
    function select($att,$cond,$name){
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

        $sql="SELECT ".$att." FROM ".$name." WHERE ".$cond;
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);

        $obj->destroySession();
        return $row;
    
    }
    function selectMul($att,$cond,$name){
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

        $sql="SELECT ".$att." FROM ".$name;

        $res=mysqli_query($conn,$sql);

        $obj->destroySession();
        return $res;
    
    }
    function delete($cond,$name){
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

        $sql="DELETE FROM ".$name." WHERE ".$cond;
        
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);

        $obj->destroySession();
        return $row; 

    }
    function update($before,$after,$name){
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

        $sql="UPDATE ".$name." SET ".$before." WHERE ".$after;
  
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);

        $obj->destroySession();
        return $row;
    }
    function insert($att,$value,$name){
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.
        
        $sql="INSERT INTO ".$name."( ".$att." ) VALUES (".$value." )";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);

        $obj->destroySession();
        return $row;

    }
}

?>