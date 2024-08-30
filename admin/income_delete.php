<?php
    include_once('../connection.php');

    // File upload folder 
    $uploadDir = '../images/income/'; 

    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {

            $getSql = "SELECT * FROM tbl_income WHERE income_id = '".$_POST['id']."'";
            $rsgetSql = mysqli_query($con, $getSql);
            if(!$rsgetSql)
            {
                die("No Record Found.".mysqli_error($con));
            }
            $rowgetSql = mysqli_fetch_array($rsgetSql);

            $income_photo =  $rowgetSql["income_photo"];

            if($income_photo != "")
            {
                unlink($uploadDir.$income_photo);
            }
            $sql_delete = "DELETE FROM tbl_company_ledger WHERE related_id = '".$_POST['id']."' AND related_obj = 'Income'";
            mysqli_query($con,$sql_delete);

            $deleteSql = "CALL deleteIncome('".$_POST['id']."')";
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