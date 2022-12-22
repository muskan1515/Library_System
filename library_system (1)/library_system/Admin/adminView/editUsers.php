<?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page will show how the edit user for admin will look
    
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

<?php

//include_once('C:/applications/htdocs/library_system/config/dbController.php');
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');


$obj=new models();

   $tval=$_GET['id'];
   //$res= mysqli_query($conn,"SELECT * FROM Users WHERE UserId='$tval'");
   $row=$obj->select(" * "," UserId = '$tval' "," Users ");
//    $row=mysqli_fetch_assoc($res);
   if($row)
    echo "Current Name :".$row['Name']." Current Password :".$row['Password'];

?>


<form id='editUser_form' >
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" placeholder="Name to Edit"><br>
  <label for="pass">Password:</label><br>
  <input type="text" id="pass" name="pass" placeholder="Password to Edit"><br>
  <div id=btn-group>
  <button type="submit" id="edit_btn" onclick="redirect12()">Save</button>
  
  <!-- <button type="submit" id="home_btn" onclick="redirect()">Home</button> -->
  <div>
</form>
</body>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  //jquery function for redirecting to the page according to the click buttons

    
    
   
    //ajax function call
   // $(document).on('click','#edit_btn',function(e){
    function redirect12(){
        event.preventDefault();
        var name=$('#name').val();
        var psw=$('#pass').val();

        
        //set the session uniqid
        var id='<?php echo $_GET['id']; ?>';
        //client side validations
        if(name==""&&psw==""){
            alert("One Should be filled!!!");
        }
        else if(name!="" && !(/^[a-zA-Z ]{2,30}$/).test(name)){
         alert('Enter a valid Name!!!');
        }
        else if( psw!="" && !(/^(?=.*[0-9])(?=.*[!@$%^&*])[a-zA-Z0-9!@$%^&*]{4,20}$/.test(psw))){
            alert("Password must be strong !!!");
        }
        else{
            $.ajax({
                // url:'../userController/Login.php',
                type:"POST",
                url:"../../action.php",
                
                data:{
                    tname:name,
                    tpass:psw,
                    id:id,
                    tval:3
                },

                //for storing and showing the reponse of the ajax function 
                success: function(data){
                   data=$.trim(data);
                   var flag=0;
                   if(data=='onepass'){
                    alert("Password Updated Successfully!!!");
                   }
                   else if(data=='onename'){
                    alert("Name Updated Successfully!!!");

                   }
                   else if(data=='two'){
                    alert("Both Name and Password Updated Successfully!!!");
                   }
                   else{
                    flag=1;
                    alert("Failed!!!");
                   }
                   flag==0?window.location.href="./adminDashboard.php":alert("Retry!!");
                }
            });
            //reseting back the form if validation were not proper
            $('#editUser_form')[0].reset();
         }
    // });
        }
    
    // //document.getElementById("home_btn").addEventListener("click",redirect);
    // function redirect(){
    //     $(".append").append("<b>show this text</b>");
    //     // console.log(window.location="C:/applications/htdocs/library_system/Admin/adminView/adminDashboard.php");
    //     // return false;
    // }

    
  
</script>
</html>


<!-- <?php
/*  Author's Name: Muskan Kushwah
    Date:           7/12/2022
    Purpose: This page will show how the edit user for admin will look
    
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
<form id='editUser_form'>
  <label for="name">Name:</label><br>
  <input type="text" id="i=name" name="name" placeholder="Name to Edit"><br>
  <label for="pass">Password:</label><br>
  <input type="text" id="i=pass" name="pass" placeholder="Password to Edit"><br>
  <div id=btn-group>
  <button type="submit" id="edit_btn">Edit</button>
  
  <button type="submit" id="home_btn">Home</button>
  <div>
</form>
</body>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  //jquery function for redirecting to the page according to the click buttons
    
    document.getElementById("home_btn").addEventListener("click",redirectFunc1);
    function redirectFunc1(){
        window.location.href="./adminDashoard.php";
    }
    document.getElementById("edit_btn").addEventListener("click",redirectFunc2);
    function redirectFunc2(){
        event.preventDefault();
        var email=$('#name').val();
        var psw=$('#pass').val();
        if(name==""&&pass==""){
            alert("One Should be filled!!!");
        }
        else if(((pass!=""||pass=="")&&(name!=name.match(/^[a-zA-Z ]{2,30}$/))){
         alert('Enter a valid Name!!!');
        }
        else if(((name==""||name!="")&&(psw!=psw.match(/^(?=.*[0-9])(?=.*[!@$%^&*])[a-zA-Z0-9!@$%^&*]{4,20}$/))){
            alert("Password must be strong !!!");
        }
        else if((psw!=psw.match(/^(?=.*[0-9])(?=.*[!@$%^&*])[a-zA-Z0-9!@$%^&*]{4,20}$/))&&(name!=name.match(/^[a-zA-Z ]{2,30}$/))){
            alert("Both should be proper and strong!!!");
        }
        else{
            $.ajax({
                // url:'../userController/Login.php',
                type:"POST",
                url:"../../action.php",
                
             
                data:{
                    tname:name,
                    tpass:psw,
                    tval:3
                },

                //for storing and showing the reponse of the ajax function 
                success: function(data){
                   data=$.trim(data);
                   if(data=='onepass'){
                    alert("Password Updated Successfully!!!");
                   }
                   else if(data=='onename'){
                    alert("Name Updated Successfully!!!");
                   }
                   else if(data=='two'){
                    alert("Both Name and Password Updated Successfully!!!");
                   }
                   else{
                    alert("Failed!!!");
                   }
                }
            });
            //reseting back the form if validation were not proper
            $('#editUser_form')[0].reset();
        }
    }
    
  
</script>
</html> -->