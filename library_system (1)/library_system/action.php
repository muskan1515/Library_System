
 


<?php
/*Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose:This page is mainly built for redirecting according to the 
$_REQUEST['tval']:  'tval'->1  (signup page) 'tval'->2 . (login page) */
 switch($_REQUEST['tval']){
    //if 1 happen then simply access the signup file and 
    //through its object get the user signed up happen
    case 1:
        include_once('./User/userController/Signup.php');
        $obj=new signupUser();
        $result=$obj->getsignuped($_REQUEST);
        break;

    //if 2 happen then simply access the login file and 
    //through its object get the user logged  up happen
    case 2:
        include_once('./User/userController/Login.php');
        $obj=new loginUser();
        $result = $obj->getlogged($_REQUEST);
        break;
    case 3:
        include_once('./Admin/adminController/editUsers.php');
        $obj=new editUser();
        $result = $obj->editUsers($_REQUEST);
        break;
    default:
        die();
 }

 return $result;


?>