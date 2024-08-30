<?php

    include_once('../connection.php');

    $cash_memo_id = $_POST['cash_memo_id'];

    $data = array();

    // get Cash memo detail data by cash memo id
    $sql_detail = "SELECT tcmd.*, ti.item_name 
                   FROM tbl_cash_memo_detail as tcmd
                   LEFT JOIN tbl_item ti ON tcmd.product_id = ti.item_id 
                   WHERE tcmd.cash_memo_id = '".$cash_memo_id."'";

    $result_detail = mysqli_query($con, $sql_detail);

    if (!$sql_detail) 
    {
        die('Error fetching data: ' . mysqli_error($con));
    }
    $data['products'] = array();

    while ($row_detail = mysqli_fetch_assoc($result_detail))
    {
        $product = array(
                    'product_id' => $row_detail['product_id'],
                    'item_name' => $row_detail['item_name'],
                    'quantity' => $row_detail['qty'],
                    'rate' => $row_detail['rate'],
                    'discount_per' => $row_detail['discount_per'],
                    'discount_amt' => $row_detail['discount_amt'],
                    'gst_per' => $row_detail['gst_per'],
                    'gst_amt' => $row_detail['gst_amt']
                );
                array_push($data['products'], $product);
    }

// Sending JSON response
echo json_encode($data);

?>
