<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the view of a Issued book for the specified Users.*/

  
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection using the object of dbControl class.


//if session is being built
if(isset($_SESSION['Uniqid'])){
$uid=$_SESSION['Uniqid'];

$tres=mysqli_query($conn,"SELECT UserId FROM Users WHERE UniqId='$uid'");
$temp=mysqli_fetch_assoc($tres);
if(!$temp){
  echo "Failed!!";
}
else{

    //setting UserId repectively to the UniqId
$tuid=$temp['UserId'];


echo "<h2>Issued Books!!!</h2>";
//getting all the related rows
$sql="SELECT * FROM Book WHERE bookId  IN (SELECT bookId FROM bookIssued WHERE UserId='$tuid')";
$res=mysqli_query($conn,"SELECT * FROM Book WHERE bookId  IN (SELECT bookId FROM bookIssued WHERE UserId='$tuid')");

if(!$res){
    echo "Not Issued Any One!!!";
}
else{
$rows=array();

while($row=mysqli_fetch_assoc($res)){
    $rows[]=$row;
}

//printing the rows 
if($rows){
    echo"<br>";
    foreach($rows as $row){
        echo " Book-Id: ".$row['bookId'].",  Book-Name: ".$row['bookName'].",  Author-Name: ".$row['authorName']."<br><br>" ;
    }
}
}
echo "<h2>Requested Books!!!</h2>";
//getting all the related rows
$sql="SELECT * FROM Book WHERE bookId  IN (SELECT bookId FROM bookRequests WHERE UserId='$tuid')";
$res=mysqli_query($conn,"SELECT * FROM Book WHERE bookId  IN (SELECT bookId FROM bookRequests WHERE UserId='$tuid')");

if(!$res){
    echo "Not Issued Any One!!!";
}
else{
$rows=array();

while($row=mysqli_fetch_assoc($res)){
    $rows[]=$row;
}

//printing the rows 
if($rows){
    echo"<br>";
    foreach($rows as $row){
        echo " Book-Id: ".$row['bookId'].",  Book-Name: ".$row['bookName'].",  Author-Name: ".$row['authorName']."<br><br>" ;
    }
}
}
}
}
else{
    echo "failed!!";
}
?>
<!Doctype html>
<style>

.btn-group button {
  background-color: #04AA6D; /* Green background */
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}


</style>
<body>

<div class="btn-group">
  <button type="submit" id="home_btn">Home</button>
</div>
</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="./userDashboard.php";
    }
</script>
</html>

