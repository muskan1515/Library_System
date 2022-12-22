<?php
/* Author's Name: Muskan Kushwah
Date: 19/11/2022
Purpose: This page show the specific user's issued books content

*/

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection started
if($conn==true){
    $uq=1;
   
    //simply check for the user's session id
   if(isset($_SESSION['UniqId'])){
      $ud=$_SESSION['UniqId'];

      //using the id get the user's UserId
      $res=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$ud'");
      $row=mysqli_fetch_assoc($res);
      $uq=$row['UniqId'];
   }

   //then simply print all the book being issued by that gathered UseriD
   $sql="SELECT * FROM Book WHERE bookId IN (SELECT bookId FROM bookIssued WHERE UserId='$uq')";
   $res=mysqli_query($conn,$sql);
   $rows=array();
   while($row=mysqli_fetch_assoc($res)){
       $rows[]=$row;
   }
   echo"<br>";
   foreach($rows as $row){
       echo " Book-Id: ".$row['bookId'].",  Book-Name: ".$row['bookName'].",  Author-Name: ".$row['authorName']."<br><br>" ;
   }
   
}
else{
   
    //if connection doesnt happen 
   return  ('Connection failed:' .mysqli_connect_error());
}


?>

<!DOCTYPE html>
<html>
<body>
    
  
  <input type="submit" id="home_btn" value="home">
</body>

<!-- including the google cdn for the ajax usability -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    // this ajax function mainly handling the client-side validation
    // and also performing the redirection from one page to another 
    // after validation
    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.replace("../userView/userDash.php");
    }
</script>

</html>

