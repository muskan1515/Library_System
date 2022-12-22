<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page will show how the delete user  will look
    
    */


$uId;

//checking if the id being passed on the url or not




//creating the session

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');

$obj=new models();


    //getting the userid asscociated to the uniqid of the session block
    $uid=$_GET['id'];
    //$tres=mysqli_query($conn,"SELECT UserId FROM Users WHERE UniqId='$uid'");
    $temp=$obj->select(" UserId "," UniqId = '$uid' "," Users ");

    $tuid=$temp['UserId'];
  
    //deleting first the userid from bookIssued and from Users
    //mysqli_query($conn,"DELETE FROM bookIssued WHERE UserId='$tuid' ");
    $obj->delete(" UserId = '$tuid' "," bookIssued ");
    //mysqli_query($conn,"DELETE FROM Users WHERE UniqId='$uId'");
    $obj->delete(" UniqId = '$uid' "," Users ");

    //redirecting back to the admin_dashboard after performing 
    header("Location:./adminDashboard.php");


?>