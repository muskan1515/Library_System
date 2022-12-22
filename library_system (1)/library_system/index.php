
 

<?php
 /*Author's Name: Muskan Kushwah
 Date: 18/11/2022
 Purpose:the main page the user will see first of the 
 library system.*/


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
<?php
 include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
 $paths=include('./config/configure.php');

 if(isset($_SESSION['Uniqid'])){
   if($_SESSION['isAdmin']==NULL){
     header("Location:.".$paths['userV']."/userDashboard.php");
   }
   else{
     header("Location:".$paths['adminV']."/adminDashboard.php");
   }
 } 
  
?>
<h1>Library Management System</h1>

<div class="btn-group">
  <button type="submit" id="sig_btn">Signup</button>
  <button type="submit" id="log_btn">Login</button>
</div>
</body>
<script>
  //jquery function for redirecting to the page according to the click buttons

    document.getElementById("sig_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="./User/userView/Signup.php";
    }
   
    document.getElementById("log_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.href="./User/userView/Login.php";
    // }
    }
</script>
</html>

