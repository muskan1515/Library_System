<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page will show how the admin dashboard will look
    
    */
    
?>

<!Doctype html>
<style>

//css styling for the buttons
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
<div class=container>
    <table class="table inner">
    <tr>
        <th>UserId</th>
        <th>UniqId</th>
        <th>Name</th>
        <th>Email</th>
        <th>ContactInfo</th>
    </tr>

    
    <?php
   
   include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');
   include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/Admin/adminController/adminClass.php');
   include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
   $paths=include('../../config/configure.php');
  
    if(!isset($_SESSION['Uniqid'])){
        header("Location:".$paths['index'].".php");
    }


    $obj=new models();
    $tobj=new adClass();
     //showing the users data
        $result=$obj->selectMul(" * ",""," Users ") ;  
        while($row=mysqli_fetch_assoc($result)){
            echo"<tr>";
            echo"<td>" .$row['UserId']."      </td>";
            echo"<td>" .$row['UniqId']."     </td>";
            echo"<td>" .$row['Name']."      </td>";
            echo"<td>" .$row['Email']."      </td>";
            echo"<td>" .$row['ContactInfo']."     </td>";
            echo"<td>
              <div class='btn-group'>
              <a  href='./editUsers.php?id=".$row['UserId']."'> Edit </a>";
            if($_SESSION['Uniqid']!=$row['UniqId'])
              echo "<a  href='./deleteUsers.php?id=".$row['UniqId']."'> Delete </a>";
              if($row['isAdmin']!=1){
                echo "<a  class='btn_sec' href='./make_Admin.php?id=".$row['UniqId']."'> .  Make Admin </a>";
              }
            
                echo "</div>";
            
            echo "</td>";
            echo"</tr>";
        }
            
    
    ?>
    </table>
    <table class="table inner">
    <tr>
        <th>UserId</th>
        <th>bookId</th>
    </tr>

    
    <?php
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/Admin/adminController/adminClass.php');
 
    $obj=new models();
    $tobj=new adClass();

       //showing the users data
        $id=$_SESSION['Uniqid'];
        $result=$obj->selectMul(" * ",""," bookRequests ");
            
        while($row=mysqli_fetch_assoc($result)){
            echo"<tr>";
            echo"<td>" .$row['UserId']."      </td>";
            echo"<td>" .$row['bookId']."     </td>";
            echo"<td>
              <div class='btn-group'>";
            echo "</div>";
            echo "<a  href='../adminController/accept.php?id=".$row['bookId']."&uid=".$row['UserId']."'>Accept </a>";
            echo "<a  href='../adminController/delete.php?id=".$row['bookId']."&uid=".$row['UserId']."'>   Delete</a>";
            // echo "<a  href='./Request.php?id=".$row['bookId']."'><h3>Request</h3></a>";

            echo "</td>";
            echo"</tr>";
        }
            
    
    
    ?>
    </table>
</div>


<button type="submit" id="user_btn">User Dashboard</button>
<button type="submit" id="logout_btn">Logout</button>
</body>
<script>

    //script for logout button for handlingthe logout scenario
    document.getElementById("logout_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.replace("../../User/userView/logout.php");
    }
    document.getElementById("user_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.replace("../../User/userView/userDashboard.php");
    }
</script>
</html>