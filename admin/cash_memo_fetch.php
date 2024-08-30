<?php
    include_once('../connection.php');

    $response = array();

    if(isset($_POST['edit']))
    {
        if(isset($_POST['id']))
        {
            $fetchSql = "CALL fetchCashMemo('".$_POST['id']."')";
            $result = mysqli_query($con,$fetchSql);
            while($row = mysqli_fetch_array($result))
            {
                $response["cash_memo_id"] = $row["cash_memo_id"];
                $response["invoice_no"] = $row["invoice_no"];
                $response["cash_memo_date"] = $row["cash_memo_date"];
                $response["customer_name"] = $row["customer_name"];
                $response["sub_total"] = $row["sub_total"];
                $response["pay"] = $row["pay"];
                $response["payment_type_id"] = $row["payment_type_id"];
                
            }
        }
    }
    else
    {
        $response["Fail"] = 1;
    }
    echo json_encode($response);
?>