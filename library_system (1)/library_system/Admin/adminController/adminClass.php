

<?php
/*  Author's Name: Muskan Kushwah
    Date:           8/12/2022
    Purpose: This class is used for checking the given UserId is admin or not
    */



include_once('/Applications/XAMPP/xamppfiles/htdocs/library_system/config/dbController.php');//including the  dbController for starting the connection.\

class adClass{

    public $old_admin="";
    public $conn;
    
    function checkAdmin($x){
      
      //setting the parameter to aa a id
      $old_admin=$x;
      
      $obj=new dbControl();
      $this->conn=$obj->getdbSession();//getting the connection using the object of dbControl class.

      if($this->conn==true){
        //query for retrieving the related row of the specified userid and not null even
        $res=mysqli_query($this->conn,"SELECT FROM Users WHERE isAdmin IS NOT NULL AND UniqId='$old_admin' ");
        if($res)
         return 'true';
        else
        return 'false';
      }
      else{
        return 'false';
      }
    }
}
?>