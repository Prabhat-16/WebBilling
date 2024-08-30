<?php
    include_once('../connection.php');


    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $deleteSql = "CALL updateFinancialYear('".$_POST['id']."')";
            if(mysqli_query($con,$deleteSql))
            {
                $set_default = "UPDATE tbl_financial_year SET is_default = 0 WHERE financial_year_id NOT IN ('".$_POST['id']."') ";
                mysqli_query($con,$set_default);

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