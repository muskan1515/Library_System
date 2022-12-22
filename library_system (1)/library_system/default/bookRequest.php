<?php
/* Author's Name: Muskan Kushwah
Date: 1/12/2022
Purpose: This page show the specific user's request books content

*/

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection started
if($conn==true){
    
  //print all the non issued books
   $sql="SELECT * FROM Book WHERE bookId NOT IN (SELECT bookId FROM bookIssued)";
   $res=mysqli_query($conn,$sql);

   $rows=array();
   while($row=mysqli_fetch_assoc($res)){
       $rows[]=$row;
   }
   echo"<br>";
   foreach($rows as $row){
    echo $row['bookId'].",  Book-Name: ".$row['bookName'].",  Author-Name: ".$row['authorName']."<br><br>";   
  }

  //check if user entered something for book issuing
   if(isset($_REQUEST['uid'])==true&& isset($_REQUEST['bookid'])==true){

    $uId=$_REQUEST['uid'];
   $bookId=$_REQUEST['bookid'];

   //simply perform the requesting scenario
   $check_bookalrdy=mysqli_query($conn,"SELECT * FROM bookIssue WHERE bookId='$bookId'");
   if(!$check_bookalrdy){
    $sql2="INSERT INTO bookRequest(UserId,bookId) VALUES('$uId','$bookId') ";
   
    //delete that book from the books
    mysqli_query($conn,"DELETE FROM Book WHERE bookId='$bookId'");
    if(mysqli_query($conn,$sql2)==true)
     echo("Successfully inserted!!!");
    else
     echo ("Failed!!!");
   }
   
  
   }
   $obj->destroySession();
}
else{
   
    //if connection doesnt happen 
   return  ('Connection failed:' .mysqli_connect_error());
}


?>


<!DOCTYPE html>
<html>
<body>
    
<form id="bookreqForm" method=POST>
  <label for="uid">Unique Id(Yours):</label><br>
  <input type="text" id="uid" name="uid" placeholder="uid  please"><br>
  <label for="bookid">Book Id:</label><br>
  <input type="text" id="bookid" name="bookid" placeholder=" book  please"><br>

  
  <input type="submit" id="req_btn" value="Request">
  <input type="submit" id="home_btn" value="home">
</form> 
<div id="response_sign"></div>
</body>

<!-- including the google cdn for the ajax usability -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    // this ajax function mainly handling the client-side validation
    // and also performing the redirection from one page to another 
    // after validation
    document.getElementById("req_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.replace("../../User/userController/bookRequest.php");
    }
    document.getElementById("home_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.replace("../userView/userDash.php");
    }
  
</script>

</html>

