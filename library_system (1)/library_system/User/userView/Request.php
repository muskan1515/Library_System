<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the view of a  request button do for the user's dashboard
    */
    


include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

$bid='';
//check if session id is st and url do contain the bookid
if(isset($_GET['id'])&&isset($_SESSION['Uniqid'])){
    $bid=$_GET['id'];
    $tval=$_SESSION['Uniqid'];

    //getting the users UserId through--> UniqId
    $res=mysqli_query($conn,"SELECT UserId FROM Users WHERE UniqId='$tval'");
    $row=mysqli_fetch_assoc($res);
    $uid=$row['UserId'];

    //inserting to the bookIssued table the required Userid and bookId respectively
$sql="INSERT INTO bookRequests (UserId,bookId) VALUES ('$uid','$bid')";
$res=mysqli_query($conn,$sql);

if($res==true){
   echo "Successfully done!!";

}
else{
  echo("Duplicate Entry!!!");
}
}
else{
    echo "failed!!1";
}
header("Location:./userDashboard.php");

?>