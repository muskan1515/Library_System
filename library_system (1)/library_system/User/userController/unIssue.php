<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the view of a  request button do for the user's dashboard
    */
    

 

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

//check if session id is st and url do contain the bookid
if(isset($_GET['id'])&&isset($_GET['uid'])){
    $bid=$_GET['id'];
    $uid=$_GET['uid'];
    
    $res=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$uid'");
    $row=mysqli_fetch_assoc($res);
    $tval=$row['UserId'];

    //delete from the book Requests table all the related bookId requests table
    mysqli_query($conn,"DELETE FROM bookIssued WHERE bookId='$bid' AND UserId='$tval'");

 
header("Location:../userView/userDashboard.php");
}
?>