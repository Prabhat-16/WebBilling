<?php
    include_once('../connection.php');
    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {
            $sql_delete = "DELETE FROM tbl_company_ledger WHERE related_id = '".$_POST['id']."' AND related_obj = 'CashMemo'";
            mysqli_query($con,$sql_delete);

            $sql_delete_detail = "DELETE FROM tbl_cash_memo_detail WHERE cash_memo_id = '".$_POST['id']."'";
            // echo $sql_delete_detail;
            mysqli_query($con,$sql_delete_detail);

            $deleteSql = "CALL deleteCashMemo('".$_POST['id']."')";
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