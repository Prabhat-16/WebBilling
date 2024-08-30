<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit'])){
        if(isset($_POST['id'])){
            $fetchSql = "CALL fetchIncome('".$_POST['id']."')";


            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["income_id"] = $row["income_id"];
                $response["income_type_id"] = $row["income_type_id"];
                $response["income_invoice_no"] = $row["income_invoice_no"];
                $response["income_invoice_date"] = $row["income_invoice_date"];
                $response["income_amount"] = $row["income_amount"];
                $response["income_description"] = $row["income_description"];
                $response["income_photo"] = $row["income_photo"];
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