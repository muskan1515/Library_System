<?php
/*  Author's Name: Muskan Kushwah
    Date:           1/12/2022
    Purpose: This page is mainly showing the page for deleting a user 
      done by admin only.
*/
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
<h1>Make Admin</h1>
<?php

/*
This will print All the available books and also let the user to be 
redirected either to book_Issue Page for letting the user issued book
or either to request for another book issue.

*/

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
  
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection started

if($conn==true){

   //simply print all data of the user excdpt admin
    $sql="SELECT * FROM Users WHERE isAdmin IS NULL";
        $result=mysqli_query($conn,$sql);
        $rows=array();
        while($row=$result->fetch_assoc()){
            $rows[]=$row;
        }
        echo"<br>";
        foreach($rows as $row){
            echo "UniqueName: ".$row['UniqId'].", Name: ".$row['Name'].", Contact-Info: ".$row['ContactInfo'].", Email: ".$row['Email']."<br><br>";    }
    
      //check if admin enteres something 
    if(isset($_REQUEST['uId'])==true&&isset($_REQUEST['uId2'])==true){
        $uid1=$_REQUEST['uId'];
        $uid2=$_REQUEST['uId2'];

         //update accordingly to the specified UniqId
        $oldAdmin_user=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$uid1' AND isAdmin IS NOT NULL ");
        $newAdmin_user=mysqli_query($conn,"SELECT * FROM Users  WHERE UniqId='$uid2' AND isAdmin IS NULL");
        if($oldAdmin_user && $newAdmin_user){
           mysqli_query($conn,"UPDATE Users SET isAdmin=NULL WHERE UniqId='$uid1'");
           mysqli_query($conn,"UPDATE Users SET isAdmin='1' WHERE UniqId='$uid2'");
           echo "Successfully done";
        }
        else{
            echo "retry!!!";
        }
    }
    
    
}
else{
     //if connection doesnt happen 
   return ('Connection failed:' .mysqli_connect_error());
}

?>
<p>

</p>
<form method='POST'>
  <label for="uId">UniqId(Current Admin):</label><br>
  <input type="text" id="uId" name="uId" placeholder=""><br>
  <label for="uId2">UniqId(to make):</label><br>
  <input type="text" id="uId2" name="uId2" placeholder=""><br>
  <div id=btn-group>
  <button type="submit" id="make_btn">Make Admin</button>
  
  <button type="submit" id="home_btn">Home</button>
  <div>
</form>
<div id=issuedb></div>

</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="../adminView/adminDash.php";
    }
    document.getElementById("make_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.href="../../User/userView/logout.php";
    }
  
</script>
</html>