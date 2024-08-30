<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit'])){
        if(isset($_POST['id'])){
            $fetchSql = "CALL fetchExpense('".$_POST['id']."')";


            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["expense_id"] = $row["expense_id"];
                $response["expense_type_id"] = $row["expense_type_id"];
                $response["expense_invoice_no"] = $row["expense_invoice_no"];
                $response["expense_invoice_date"] = $row["expense_invoice_date"];
                $response["expense_amount"] = $row["expense_amount"];
                $response["expense_description"] = $row["expense_description"];
                $response["expense_photo"] = $row["expense_photo"];
                $response["payment_type_id"] = $row["payment_type_id"];
                $response["financial_year_id"] = $row["financial_year_id"];
            }
        }
    }
    else
    {
        $response["fail"] = 1;
    }
    echo json_encode($response);
?>