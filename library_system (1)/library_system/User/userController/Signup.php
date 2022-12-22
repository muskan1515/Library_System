


<?php
/* Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose: The class signupUser is created to make the user signed up to the library system,
 & also managing the insertion of the new user's data to the database table -->User.
*/



session_start();
class signupUser{

    // this function check for validation and for the data insertion to the table happen
    function getsignuped(){
 
    //for letting the dbController file added for building the connection    
    include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');
  
    $obj=new dbControl();
    $conn=$obj->getdbSession();//getting the connection started

    if($conn==true){

        //putting to the local variable the values that needed for inserting in table
        $name=$_POST['tname'];
        $uniId=$_POST['tuniId'];
        $email=$_POST['temail'];
        $contactinfo=$_POST['tcont'];
        $pass=$_POST['tpass'];
        $hpass=hash('sha256',$pass);
        
    
        //handling all the exceptions of the validations for server-side 
        $namereg="/^[a-zA-Z ]{2,30}$/";
        $mobreg='/^[0-9]{10}+$/';
        $emailreg="/^[a-z0-9_%+-]+@[a-z0-9-]+\.[a-z]{2,4}$/";
        $pswreg="/^(?=*[0-9])(?=*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,20 }$/";
         
        if($name==''||!preg_match($namereg,$name)){
          echo 'namef';
          exit();
        }
        else if($uniId==''){
          echo 'uniidf';
          exit();
        }
        else if($email==''||!preg_match($emailreg,$email)){
          echo 'emailf';
          exit();
        }
        else if($contactinfo==''||!preg_match($mobreg,$contactinfo)){
          echo 'contactf';
          exit();
        }
        else if($pass==''){
          echo 'phonef';
          exit();
        }
        else{
        //chechking for the duplications
            $sql=mysqli_query($conn,"SELECT * FROM Users WHERE UniqId='$uniId' OR Email='$email' OR ContactInfo='$contactinfo'");
            $rows=array();
            while($row=mysqli_fetch_assoc($sql)){
              $rows[]=$row;
            }
            foreach($rows as $row){
              if($row['UniqId']==$uniId){
                echo 'UniqIdex';
                exit();
              }
              else if($row['Email']==$email){
                echo 'Emailex';
                exit();
              }
              else if($row['ContactInfo']==$contactinfo){
                echo 'Phoneex';
                exit();
              }

            }
            $res=mysqli_query($conn,"INSERT INTO Users (UniqId,Name,Email,ContactInfo,Password) VALUES('$uniId','$name','$email','$contactinfo','$pass')");
            if($res>0){
          
              $_SESSION['Uniqid']=$uniId;
              $_SESSION['isAdmin']=NULL;
              session_commit();
              echo 'true';
            }
            else{
              echo 'false';
            }
            //destroying the connection using the destroySession() of the dbControl class 
            $obj->destroySession();
        }
        
    }
    else{
      
        //if connection doesnt happen 
        return  ('Connection failed:' .mysqli_connect_error());
    }
  }
}
?>