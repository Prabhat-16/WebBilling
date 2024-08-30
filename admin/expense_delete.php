<?php
    include_once('../connection.php');

    // File upload folder 
    $uploadDir = '../images/expense/'; 

    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {

            $getSql = "SELECT * FROM tbl_expense WHERE expense_id = '".$_POST['id']."'";
            $rsgetSql = mysqli_query($con, $getSql);
            if(!$rsgetSql)
            {
                die("No Record Found.".mysqli_error($con));
            }
            $rowgetSql = mysqli_fetch_array($rsgetSql);

            $expense_photo =  $rowgetSql["expense_photo"];

            if($expense_photo != "")
            {
                unlink($uploadDir.$expense_photo);
            }

            $sql_delete = "DELETE FROM tbl_company_ledger WHERE related_id = '".$_POST['id']."' AND related_obj = 'Expense'";
            mysqli_query($con,$sql_delete);

            $deleteSql = "CALL deleteExpense('".$_POST['id']."')";
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