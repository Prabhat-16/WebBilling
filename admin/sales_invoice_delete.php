<?php
    include_once('../connection.php');
    $response = array();

    if(isset($_POST['delete']))
    {
        if(isset($_POST['id']))
        {
            $sql_delete = "DELETE FROM tbl_company_ledger WHERE related_id = '".$_POST['id']."' AND related_obj = 'SO'";
            mysqli_query($con,$sql_delete);

            $sql_delete_detail = "DELETE FROM tbl_sales_invoice_detail WHERE sales_invoice_id = '".$_POST['id']."'";
            // echo $sql_delete_detail;
            mysqli_query($con,$sql_delete_detail);

            $sql_party_ledger_delete = "DELETE FROM tbl_party_ledger WHERE related_id = '".$_POST['id']."' AND related_obj_name = 'SO' ";
            $rs_party_ledger_delete = mysqli_query($con,$sql_party_ledger_delete);

            $deleteSql = "CALL deleteSalesInvoice('".$_POST['id']."')";
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