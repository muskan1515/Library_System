
<?php
/*Author's Name: Muskan Kushwah
  Date: 7/12/2022
  Purpose: The class editUser mainly there name or the 
  password .
  */

class editUser{

//This is the function that accessing the database connection 
//and chechking the database for logging in.
function editUsers(){

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/Models.php');
//include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\
$obj=new models();

 //putting to the local variable the values that needed for inserting in table
    $name=$_POST['tname'];
    $pass=$_POST['tpass'];
 
    //handling all the exceptions of the validations for server-side 
    $namereg="/^[a-zA-Z ]{2,30}$/";
    $pswreg="/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,20}$/";

    //doing server side validations
    if($name!=''&& !preg_match($namereg,$name)){
         echo 'false';
     }
    else if($pass!=''&& !preg_match($pswreg,$pass)){
         echo 'false';
    }
    else{
    //get the reuqested credentials
        $name=$_POST['tname'];
        $pass=$_POST['tpass'];
        $uid=$_POST['id'];

    //if both are being modified
        if($name!='' && $pass!=''){
            $res=$obj->update(" Name='$name' , Password = '$pass' "," UserId = '$uid' "," Users ");
            if($res)
             echo 'two';
            else
             echo 'false';
        }

    //if name is being modified
        else if($name!='' && $pass==''){
            $res=$obj->update(" Name = '$name' "," UserId = '$uid' "," Users ");
            var_dump($res);
            die();
            if($res)
             echo 'onename';
            else
             echo 'false';
        }

    //if password is being modified
        else if($name=='' && $pass!=''){
            $res=$obj->update("  Password = '$pass' "," UserId = '$uid' "," Users ");
            if($res)
             echo 'onepass';
            else
             echo 'false';
        }
        else{
            echo 'false';
        }
    }





}
}

