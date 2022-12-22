
<?php
/*  Author's Name: Muskan Kushwah
    Date:           19/11/2022
    Purpose: This page is mainly showing the view of a user's Dashboard of the library system.*/
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
<h1>User's Dashboard</h1>
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
    $sql="SELECT * FROM Book ";
    $result=mysqli_query($conn,$sql);
    $rows=array();
    while($row=$result->fetch_assoc()){
        $rows[]=$row;
    }
    echo"<br>";
    foreach($rows as $row){
        echo $row['bookId'].",  Book-Name: ".$row['bookName'].",  Author-Name: ".$row['authorName']."<br><br>";
    }
    
    
}
else{
     //if connection doesnt happen 
   return ('Connection failed:' .mysqli_connect_error());
}

?>
<div class="btn-group">
  <button type="submit" id="issue_btn">Issued Book</button>
  <button type="submit" id="request_btn">Make A Request</button>
</div>
<div id=issuedb></div>

</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

  document.getElementById("issue_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.replace("../userController/bookIssue.php");
    }
  
    document.getElementById("request_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.href="../userController/bookRequest.php";
    }
  
</script>
</html>