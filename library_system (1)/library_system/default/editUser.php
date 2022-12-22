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
<h1>Edit the User</h1>
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
    if(isset($_REQUEST['uId'])==true){
        $uid=$_REQUEST['uId'];

        //check if entered both name and password modification
        if(isset($_REQUEST['name'])==true&&isset($_REQUEST['pass'])==true){
            $tname=$_REQUEST['name'];
            $tpass=$_REQUEST['pass'];

            //update accordingly to the specified UniqId
            $tmp=mysqli_query($conn,"UPDATE Users SET Name='$tname' , Password='$tpass' WHERE UniqId='$uid'");
            if($tmp)
             echo"updated Successfully!!!";
            else
             echo "failed!!!";
        }

        //check if entered name  modification
        else if(isset($_REQUEST['name'])==true){
            $tname=$_REQUEST['name'];

            //update accordingly to the specified UniqId
            $tmp=mysqli_query($conn,"UPDATE Users SET Name='$tname' , Password='$tpass' WHERE UniqId='$uid'");
            if($tmp)
             echo"updated Successfully!!!";
            $tmp=mysqli_query($conn,"UPDATE Users SET Name='$tname' WHERE UniqId='$uid'");
            if($tmp)
             echo"updated Successfully!!!";
            else
             echo "failed!!!";
        }

         //check if entered  password modification
        else if(isset($_REQUEST['pass'])==true){
            $tpass=$_REQUEST['pass'];

            //update accordingly to the specified UniqId
            $tmp=mysqli_query($conn,"UPDATE Users SET Name='$tname' , Password='$tpass' WHERE UniqId='$uid'");
            if($tmp)
             echo"updated Successfully!!!";
            $tmp=mysqli_query($conn,"UPDATE Users SET Password='$tpass' WHERE UniqId='$uid'");
            if($tmp)
             echo"updated Successfully!!!";
            else
             echo "failed!!!";
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
  <label for="uId">UniqId:</label><br>
  <input type="text" id="uId" name="uId" placeholder="Id to Edit"><br>
  <label for="name">Name:</label><br>
  <input type="text" id="i=name" name="name" placeholder="Name to Edit"><br>
  <label for="pass">Password:</label><br>
  <input type="text" id="i=pass" name="pass" placeholder="Password to Edit"><br>
  <div id=btn-group>
  <button type="submit" id="edit_btn">Edit</button>
  
  <button type="submit" id="home_btn">Home</button>
  <div>
</form>
<div id=issuedb></div>

</body>
<script>
  //jquery function for redirecting to the page according to the click buttons
    
    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="./adminDash.php";
    }
    document.getElementById("edit_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        var id=$('#uId').val();
        if(id==""){
           alert("UniqId cant be empty!!!");
        }
        window.location.href="./editUser.php";
    }
  
</script>
</html>