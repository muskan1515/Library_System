
<?php
/*Author's Name: Muskan Kushwah
    Date: 18/11/2022
    Purpose: The class loginUser is created to make the user logged in,
     also the chechking state of a user to that of the database.
     */

    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
    


class loginUser{

//This is the function that accessing the database connection 
//and chechking the database for logging in.
function getlogged(){


// include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
// $obj=new dbControl();
// $conn=$obj->getdbSession();//getting the connection using the object of dbControl class.
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');//including the  dbController for starting the connection.\
    $ob=new models();

    //putting to the local variable the values that needed for inserting in table
    $email=$_POST['temail'];
    $pass=$_POST['tpass'];

    //handling all the exceptions of the validations for server-side 
    $emailreg="/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
    $pswreg="/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,20}$/";
    if($email=='' || !preg_match($emailreg,$email)){
         return 'notvalidemail';
     }
    else if($pass==''||!preg_match($pswreg,$pass)){
         return 'notvalidpass';
     }
    else{
    
    $row=$ob->select(" * ","Email='$email' AND Password='$pass'"," Users ");
    // $sql="SELECT * FROM Users  WHERE Email='$email' AND Password='$pass'";
    // $result=mysqli_query($conn,$sql);
    // $row=mysqli_fetch_assoc($result);
  
    if($row){
     $_SESSION['Uniqid']=$row['UniqId'];
     $_SESSION['isAdmin']=$row['isAdmin'];
     session_commit();
   }
  
    if($row && $row['isAdmin']==NULL){
      echo 'false';
    }
    else if($row && $row['isAdmin']!=NULL){
        echo 'true';
    }
    else{
        echo 'not in';
    }
   
    
    //destroying the connection using the destroySession() of the dbControl class 
   
    
    }
}
}