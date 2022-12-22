<?php
/*  Author's Name: Muskan Kushwah
    Date:           8/12/2022
    Purpose: This class will show either book is being issued to the 
    specified user,still pending or being already issued toother users 
*/


class Issued{
    public $bid="";
    public $UId="";

    function checkIssued($y){
      
      include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
      $obj=new dbControl();
      $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.
      if($conn==true){
        $bid=$y;
      $tval=$_SESSION['Uniqid'];
      $tres=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$tval'");
      $trow=mysqli_fetch_assoc($tres);
      $UId=$trow['UserId'];
        $res=mysqli_query($conn,"SELECT * FROM bookIssued WHERE UserId='$UId' AND bookId='$bid' ");
        $row=mysqli_fetch_assoc($res);
        return $row;
    }
  }
    function checkpend($y){
      $bid=$y;
      
      include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
      $obj=new dbControl();
      $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.
      if($conn==true){
        $tval=$_SESSION['Uniqid'];
        $tres=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$tval'");
        $trow=mysqli_fetch_assoc($tres);
        $UId=$trow['UserId'];
        $res=mysqli_query($conn,"SELECT * FROM bookRequests WHERE UserId='$UId' AND bookId='$bid' ");
        $row=mysqli_fetch_assoc($res);
        return $row;
      }
    }
      function checkother($x){
        $bid=$x;
       
        include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
        $obj=new dbControl();
        $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.
        if($conn==true){
          $res=mysqli_query($conn,"SELECT * FROM bookIssued WHERE bookId='$bid' ");
          $row=mysqli_fetch_Assoc($res);
          return $row;
        }
      }
}
?>