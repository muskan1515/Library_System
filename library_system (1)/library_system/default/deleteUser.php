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
<h1>Delete the User</h1>
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
   
  //printing all the users except admin
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
        if(isset($_REQUEST['uId'])){
            $uid=$_REQUEST['uId'];
            
            //check and delete if the UniqId is not associated to the the admin credentials
            $res=mysqli_query($conn,"DELETE FROM Users WHERE UniqId='$uid' AND isAdmin IS NULL");
            mysqli_query($conn,"DELETE FROM bookIssued WHERE UserId='$uid'");
            if($res>0){
              echo "deleted successfully!!!";
            }
            else{
              echo "failed";
            }
        }

        //when triggered delete button without data
        else{
          echo "this field cant be empty!!";
        }
}
else{
     //if connection doesnt happen 
   return ('Connection failed:' .mysqli_connect_error());
}

?>
<form id="del_form" method=POST>
  <label for="uId">UniqId:</label><br>
  <input type="text" id="i=uId" name="uId" placeholder="Id to Edit"><br>
  <button type="submit" id="del_btn">Delete</button>
  <button type="submit" id="home_btn">Home</button>
</div>
<div id=issuedb></div>

</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="../adminView/adminDash.php";
    }
    document.getElementById("del_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.href="../adminView/deleteUser.php";
    }
  
</script>
</html>