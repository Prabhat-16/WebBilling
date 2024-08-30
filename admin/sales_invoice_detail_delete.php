<?php
    include_once('../connection.php');
    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {
            $deleteSql = "DELETE FROM tbl_sales_invoice_detail WHERE sales_invoice_detail_id   = '".$_POST['id']."'";
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