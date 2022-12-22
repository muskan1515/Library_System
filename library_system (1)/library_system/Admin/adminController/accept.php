<?php
/*  Author's Name: Muskan Kushwah
    Date:           8/12/2022
    Purpose: This page is mainly showing the work flow of accept 
    button for the issuing book request done by admin
    */

    //chehcking the either session is sey or unset



include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');//including the  dbController for starting the connection.\
$obj=new models();

//check if session id is st and url do contain the bookid
if(isset($_GET['id'])&&isset($_GET['uid'])){
    $bid=$_GET['id'];
    $uid=$_GET['uid'];
    

    //delete from the book Requests table all the related bookId requests table
    //mysqli_query($conn,"DELETE FROM bookRequests WHERE bookId='$bid'");
    $obj->delete(" bookId='$bid' "," bookRequests ");
    //insert back to the Issued Table
    $obj->insert(" UserId,bookId "," '$uid','$bid' "," bookIssued ");
    //mysqli_query($conn,"INSERT INTO bookIssued (UserId,bookId) VALUES('$uid','$bid')");

header("Location:../adminView/adminDashboard.php");
}
?>