
<?php 
/*Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose: This page is mainly showing the view of a signup page of the library system.*/


?>
<!DOCTYPE html>
<html>
<body>

<!-- html code for the form accepting the required information of new user .
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
<form id="signupForm" >
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" placeholder="Name please" value="<?php echo (!empty($_GET['name']) ? $_GET['name'] : '');?>"><br>
  <label for="uniId"><br><font size="2">(Can Contain Aphabet,Number,<br>Special_Char(!@$_) only!!!)<br></font>UniqId:</label><br>
  <input type="text" id="uniId" name="uniId" placeholder="UniqueId please" value="<?php echo (!empty($_GET['uniId']) ? $_GET['uniId'] : '');?>"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" placeholder="Email please" value="<?php echo (!empty($_GET['email']) ? $_GET['email'] : '');?>"><br><br>
  <label for="contInfo"><br><font size="2">(must be in the format 9192XXXXXX)<br></font>Contact: </label><br></label><br>
  <input type="text" id="contInfo" name="contInfo" placeholder="Contact please" value="<?php echo (!empty($_GET['contInfo']) ? $_GET['contInfo'] : '');?>"><br><br>
  <label for="pass"><br><font size="2">(Can Contain Aphabet,Number,<br>Special_Char(!@$%^&*) only!!!)<br></font>Password: </label><br>
  <input type="password" id="pass" name="pass" value="" value="<?php echo (!empty($_GET['pass']) ? $_GET['pass'] : '');?>"><br><br>
  <label for="rPass">Re-enter Password:</label><br>
  <input type="password" id="rPass" name="rPass" value=""><br><br>
  <input type="submit" id="subbtn" value="Submit">
</form> 
<div id="response_sign"></div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- including the google cdn for the ajax usability -->
<script>

    // this ajax function mainly handling the client-side validation
    // and also performing the redirection from one page to another 
    // after validation
    $(document).on('click','#subbtn',function(e){
       
        e.preventDefault();
        var email=$('#email').val();
        var psw=$('#pass').val();
        var psw2=$('#rPass').val();
        var name=$('#name').val();
        var cntinfo=$('#contInfo').val();
        var  uniId=$('#uniId').val();
        
        var atpos=email.indexOf('@');
        var dotpos=email.lastIndexOf('.com');
        var dotpos2=email.lastIndexOf('.in');
        if(name==""||name!=name.match(/^[a-zA-Z ]{2,30}$/)){
         alert('Enter a valid Name!!!');
        }
        else if(uniId=='')
         alert('Unique Id cannot be empty!!');
        else if(uniId!=uniId.match(/^[a-zA-Z0-9!@$_]*$/))
         alert('UniqId must follows the pattern!!');
        else if(email==''||email!=email.match(/^[a-zA-Z0-9_%]+@[a-zA-Z0-9]+\.[a-z]{2,4}$/)){
            alert('Follow the pattern for email!!');
        }
        else if(cntinfo!=cntinfo.match("[0-9]+")||cntinfo.length<10||cntinfo.length>10){
            alert("Invalid Contact Info");
        }
        else if(psw==""){
            alert("Password cannot be empty !!!");
        }
        else if(psw!=psw.match(/^(?=.*[0-9])(?=.*[!@$%^&*])[a-zA-Z0-9!@$%^&*]{4,20}$/)){
            alert("Password must be strong !!!");
        }
        else if(psw.length<4){
            alert("Password must be of length 4 !!!");
        }
        else if(psw2!=psw){
           alert("Enter the same Password!!!");
        }
        else{
            
            $.ajax({
                // url:'../userController/Signup.php',
                url:'../../action.php',
                type:'post',
                data:{
                    tname:name,
                    tuniId:uniId,
                    temail:email,
                    tpass:psw,
                    tcont:cntinfo,
                    tval:1
                },

                //for storing and showing the reponse of the ajax function
                success: function(data){
                    data=$.trim(data);
                    if(data=='namef'){
                      alert('Enter a valid name!!');
                    }
                    else if(data=='uniidf'){
                        alert('Enter a valid UniqId!!');
                    }
                    else if(data=='emailf'){
                        alert('Enter a valid Email!!');
                    }
                    else if(data=='contactf'){
                        alert('Enter a valid Contact!!');
                    }
                    else if(data=='passf'){
                        alert('Enter a valid and string Password!!');
                    }
                    else if(data=='UniqIdex'){
                        alert('This UniqId already exists!!!!');

                    }
                    else if(data=='Emailex'){
                        alert('This Email already exists!!!!');
                    }
                    else if(data=='Phoneex'){
                        alert('This Contact No. already exists!!!!');
                    }
                   else if(data=='false'){
                    alert("Retry!!!");
                   window.location.href="../../index.php";
                   }
                   else if(data=='true'){
                    window.location.href="./userDashboard.php"; 
                   }
                } 
            });

            //reseting back the form if validation were not proper
            $('#signupForm')[0].reset();
        }
        
    });
</script>

</html>

