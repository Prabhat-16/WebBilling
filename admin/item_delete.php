<?php
    include_once('../connection.php');

    // File upload folder 
    $uploadDir = '../images/item/'; 

    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {

            $getSql = "SELECT * FROM tbl_item WHERE item_id = '".$_POST['id']."'";
            $rsgetSql = mysqli_query($con, $getSql);
            if(!$rsgetSql)
            {
                die("No Record Found.".mysqli_error($con));
            }
            $rowgetSql = mysqli_fetch_array($rsgetSql);

            $item_photo =  $rowgetSql["item_photo"];

            if($item_photo != "")
            {
                unlink($uploadDir.$item_photo);
            }

            $deleteSql = "CALL deleteItem('".$_POST['id']."')";
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