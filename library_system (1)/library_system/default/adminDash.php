<?php
/*  Author's Name: Muskan Kushwah
    Date:           19/11/2022
    Purpose: This page is mainly showing the view of a Admin's Dashboard of the library system.*/
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
<h1>Admin's Dashboard</h1>
<?php

/*
This will print All the available books and also let the user to be 
redirected either to book_Issue Page for letting the user issued book
or either to request for another book issue.

*/

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
  
$obj=new dbControl();
$conn=$obj->getdbSession();//getting the connection started
$tmp=1;

if($conn==true){
    $sql="SELECT * FROM Users WHERE isAdmin IS NULL";
    $result=mysqli_query($conn,$sql);
    $rows=array();
    while($row=mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    echo"<br>";
    foreach($rows as $row){
        echo $row['UserId'].",  Unique-Name: ".$row['UniqId'].",  Name: ".$row['Name'].",  Email: ".$row['Email'].",  Contact: ".$row['ContactInfo']."<br><br>" ;
    }
    
    
}
else{
     //if connection doesnt happen 
   return ('Connection failed:' .mysqli_connect_error());
}

?>
<div class="btn-group">
  <button type="submit" id="edit_user">Edit A User</button>
  <button type="submit" id="del_user">Delete A User</button>
  <button type="submit" id="request_btn">Request A User</button>
  <button type="submit" id="make_admin">Make Admin</button>
</div>
<div id=issuedb></div>

</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

  // $(document).on('click','#issue_btn',function(e){
  //       window.location.href="../userController/bookIssue.php";
  // });
    
    document.getElementById("edit_user").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="./editUser.php";
    }

    document.getElementById("del_user").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.href="./deleteUser.php";
    }

    document.getElementById("request_btn").addEventListener("click",redirectFunc3);
    function redirectFunc3(){
        window.location.href="../../User/userController/bookRequest.php";
    }

    document.getElementById("make_admin").addEventListener("click",redirectFunc4);
    function redirectFunc4(){
        window.location.href="./makeAdmin.php";
    }

</script>
</html>