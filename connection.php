<?php
    $con = mysqli_connect('localhost','root','0000');
    if(!$con)
    {
        die('Not Connected with Host.'.mysqli_error($con));
    }
    //  else
    //  {
    //      echo "Connected Succesfully";
    //  }
    $db = mysqli_select_db($con,'kraftpaperonline');
    if(!$db)
    {
        die('Not Connected with DB.'.mysqli_error($con));
    }
?>