<?php
    
    session_start();  
    if(!$_SESSION['user_id'])
    {
        echo "<script>window.location = 'index.php';</script>";
    }
    else
    {
        unset($_SESSION['user_id']);      
        session_destroy();  
        echo "<script>window.location = 'index.php';</script>";
    }
    

?>