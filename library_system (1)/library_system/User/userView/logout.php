


<?php
/*
Author's Name: Muskan Kushwah
Date: 18/11/2022
Purpose:this page is mainly for the logging out of a user
*/

include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/sessionHelp.php');
unset($_SESSION['Uniqid']);
unset($_SESSION['Email']);
session_commit();
header("location:../../index.php");
?>