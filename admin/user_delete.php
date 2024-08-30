<?php
    include_once('../connection.php');

    // File upload folder 
    $uploadDir = '../images/user/'; 

    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {

            $getSql = "SELECT * FROM tbl_user WHERE user_id = '".$_POST['id']."'";
            $rsgetSql = mysqli_query($con, $getSql);
            if(!$rsgetSql)
            {
                die("No Record Found.".mysqli_error($con));
            }
            $rowgetSql = mysqli_fetch_array($rsgetSql);

            $user_profile =  $rowgetSql["user_profile"];

            if($user_profile != "")
            {
                unlink($uploadDir.$user_profile);
            }

            $deleteSql = "CALL deleteUser('".$_POST['id']."')";
            if(mysqli_query($con,$deleteSql))
            {
                $response["Success"] = 1;
            }
            else
            {
                $response["Fail"] = 1;
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>