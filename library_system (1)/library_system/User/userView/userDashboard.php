<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page is mainly showing the view of a User's Dashboard of the library system.*/

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
<div class=container>
    <table class="table inner">
    <tr>
        <th>bookId</th>
        <th>book_Name</th>
        <th>Author_Name</th>
    </tr>
    <?php
     
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/User/userController/bIssued.php');
    $paths=include('../../config/configure.php');
    if(!isset($_SESSION['Uniqid']))
        header("Location:".$paths['index'].".php");
        
    //echo($_SESSION['Uniqid']);
    //creating the session
    // include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
    // include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/User/userController/bIssued.php');

    $obj=new models();
    $tobj=new Issued();
        $result=$obj->selectMul(" * ",""," Book ");
        
        //printing all the books in the form of table
        while($row=$result->fetch_assoc()){
            echo"<tr>";
            echo"<td>" .$row['bookId']."      </td>";
            echo"<td>" .$row['bookName']."     </td>";
            echo"<td>" .$row['authorName']."      </td>";
            echo"<td>
              <div class='btn-group'>";
              //check if book is already in bookIssued table then hide the request button
              $t=$tobj->checkIssued($row['bookId']);
              $t2=$tobj->checkpend($row['bookId']);
              $t3=$tobj->checkother($row['bookId']);
              
              if($t){
                echo "<h4>Issued</h4>";
                echo "<a  href='../userController/unIssue.php?id=".$row['bookId']."&uid=".$_SESSION['Uniqid']."'><h4>Remove</h4></a>";
              }
              else if($t2){
                echo "<h4>Pending</h4>";
              }
              else if($t3){
                echo "<h4>Unavailable</h4>";
              }
              else{
                echo "<a  href='./Request.php?id=".$row['bookId']."'><h4>Request</h4></a>";
              }
              echo "</div>";
            
            echo "</td>";
            echo"</tr>";
        }
            
    
    
    ?>
    </table>
</div>
<?php
 if($_SESSION['isAdmin']!=NULL){
    echo "<a  href='../../Admin/adminView/adminDashboard.php'> Admin Dashboard</a>";
 }
?>
<button type="submit" id="issue_btn">Issued Book</button>
<button type="submit" id="logout_btn">Logout</button>
</body>
<script>
  //jquery function for redirecting to the page according to the click buttons
  document.getElementById("issue_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.replace("./IssuedBook.php");
    }
    document.getElementById("logout_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        window.location.replace("./logout.php");
    }
</script>
</html>