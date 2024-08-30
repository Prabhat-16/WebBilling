<?php

    include_once('../connection.php');

    $invoice_no = $_POST['invoice_no'];

    $sql = "SELECT * FROM tbl_cash_memo WHERE invoice_no = '".$invoice_no."'";
    $result = mysqli_query($con, $sql);

    if (!$result) 
    {
        die('Error fetching data: ' . mysqli_error($con));
    }

    $data = array();

    $row = mysqli_fetch_array($result);

    $data['cash_memo_info'] = array(
            'cash_memo_id' => $row['cash_memo_id'],
            'customer_name' => $row['customer_name'],
            'mobile_no' => $row['mobile_no'],
            'narration' => $row['narration'],
            'place_of_supply_id' => $row['place_of_supply_id']
        );

    // echo $row['cash_memo_id'];

    // get Cash memo detail data by cash memo id
    $sql_detail = "SELECT tcmd.*, ti.item_name 
                   FROM tbl_cash_memo_detail as tcmd
                   LEFT JOIN tbl_item ti ON tcmd.product_id = ti.item_id 
                   WHERE tcmd.cash_memo_id = '".$row['cash_memo_id']."'";

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



// $data['cash_memo_info'] = array(
//     'customer_name' => $row['customer_name'],
//     'mobile_no' => $row['mobile_no'],
//     'narration' => $row['narration'],
//     'cash_memo_date' => $row['cash_memo_date'],
//     'place_of_supply_id' => $row['place_of_supply_id'],
//     'sub_total' => $row['sub_total'],
//     'pay' => $row['pay'],
//     'payment_type_id' => $row['payment_type_id']
// );

// $data['products'] = array();
// do {
//     $product = array(
//         'product_id' => $row['product_id'],
//         'item_name' => $row['item_name'],
//         'quantity' => $row['qty'],
//         'rate' => $row['rate'],
//         'discount_per' => $row['discount_per'],
//         'discount_amt' => $row['discount_amt'],
//         'gst_per' => $row['gst_per'],
//         'gst_amt' => $row['gst_amt']
//     );
//     array_push($data['products'], $product);
// } while ($row = mysqli_fetch_assoc($result));

// Sending JSON response
echo json_encode($data);

?>
