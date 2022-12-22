<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the view of a  request button do for the user's dashboard
    */

//checking the either session is set or not    

   
    


include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');//including the  dbController for starting the connection.\
$obj=new models();
//check if session id is st and url do contain the bookid
if(isset($_GET['id'])&&isset($_GET['uid'])){
    $bid=$_GET['id'];
    $uid=$_GET['uid'];
    

    //delete from the book Requests table all the related bookId requests table
    
   $obj->delete(" bookId='$bid' AND UserId='$uid' "," bookRequests ");
   
header("Location:../adminView/adminDashboard.php");
}
?>