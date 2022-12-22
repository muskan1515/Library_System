<?php

/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the page for deleting a user 
      done by admin only.
*/




$uId;

//checking if the id being passed on the url or not
if(isset($_GET['id'])){
  $uId=strval($_GET['id']);
}

//creating the session
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection started

if($conn==true){

    mysqli_query($conn,"UPDATE Users SET isAdmin='1' WHERE UniqId='$uId'");
    
    //redirecting back to the admin_dashboard after performing
    header("Location:./adminDashboard.php");
}
else{
     //if connection doesnt happen 
   echo ('Connection failed:' .mysqli_connect_error());
}
?>