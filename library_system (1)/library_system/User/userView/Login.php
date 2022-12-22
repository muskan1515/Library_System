<?php
/*
 Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose: This page is mainly showing the view of a login page of the library system.
*/

 
 //}
?>
<!DOCTYPE html>
<html>
<body>

<!-- 
html code for the form accepting the email and password for
 further use and checking for building the session. -->

<?php
include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');  
$paths=include('../../config/configure.php');

if(isset($_SESSION['Uniqid'])){
    if($_SESSION['isAdmin']==NULL){
      header("Location:".$paths['userV']."/userDashboard.php");
    }
    else{
      header("Location:".$paths['adminV']."/adminDashboard.php");
    }
  }
  
?>
<h2>HTML Forms</h2>
<form id="loginForm">
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" placeholder="Email please"><br>
  <label for="pass">Password:</label><br>
  <input type="password" id="pass" name="pass" value=""><br><br>
  <input type="submit" id="logbtn" value="Submit">
  <div id="msg"></div>
</form> 
</body>

<!-- including the google cdn for the ajax usability -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    var response="";
    // this ajax function mainly handling the client-side validation
    // and also performing the redirection from one page to another 
    // after validation

    $(document).on('click','#logbtn',function(event){
        
        event.preventDefault();
        var email=$('#email').val();
        var psw=$('#pass').val();
        var atpos=email.indexOf('@');
        var dotpos=email.lastIndexOf('.com');
        if(email==''){
            alert(' Email cant be Empty!!');
        }
        else if(email!=email.match(/^[a-zA-Z0-9_%]+@[a-zA-Z0-9]+\.[a-z]{2,4}$/)){
            alert('Email is not valid!!');
        }
        else if(psw==''){
            alert("Password cant be empty !!!")
        }
        else if(psw!=psw.match(/^(?=.*[0-9])(?=.*[!@$%^&*])[a-zA-Z0-9!@$%^&*]{4,20}$/)){
            alert("Password must be strong !!!");
        }
        else{
            $.ajax({
                // url:'../userController/Login.php',
                type:"POST",
                url:"../../action.php",
                
             
                data:{
                    temail:email,
                    tpass:psw,
                    tval:2
                },

                //for storing and showing the reponse of the ajax function 
                success: function(data){
                   data=$.trim(data);
                   if(data==''){
                    alert("Both must be strong and valid!!");
                   }
                   else if(data=='false'){
                    window.location.href="./userDashboard.php";}
                   else if(data=='true'){
                   window.location.href="../../Admin/adminView/adminDashboard.php";
                    }
                   else{
                    alert(" Wrong Credentials!!!");
                   }
                 }
            });
            //reseting back the form if validation were not proper
            $('#loginForm')[0].reset();
        }
        
    });
</script>

</html>

