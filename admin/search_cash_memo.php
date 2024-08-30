<?php

include_once('../connection.php');

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$customer_name = $_POST['customer_name'];
$mobile_no = $_POST['mobile_no'];

$sql_search = "SELECT cm.*, pt.payment_type 
              FROM tbl_cash_memo cm 
              LEFT JOIN tbl_payment_type pt ON cm.payment_type_id = pt.payment_type_id 
              WHERE 1=1"; 

// Adding conditions based on the search parameters
if ($start_date !== '') 
{
    $sql_search .= " AND cm.cash_memo_date >= '$start_date'";
}
if ($end_date !== '') 
{
    $sql_search .= " AND cm.cash_memo_date <= '$end_date'";
}
if ($customer_name !== '') 
{
    $sql_search .= " AND cm.customer_name = '$customer_name'";
}
if ($mobile_no !== '') 
{
    $sql_search .= " AND cm.mobile_no = '$mobile_no'";
}

// Execute the SQL query
$rs_search = mysqli_query($con, $sql_search);

if (!$rs_search) {
    die('Error: ' . mysqli_error($con));
}

// Display the results
$counter = 0;
$totalAmount = 0; 
while ($row_view = mysqli_fetch_array($rs_search)) 
{
    $counter++;
    $totalAmount += $row_view['pay']; 
    echo "<tr>";
    // echo "<td>$counter</td>";
    echo "<td>{$row_view['invoice_no']}</td>";
    echo "<td>{$row_view['cash_memo_date']}</td>";
    echo "<td>{$row_view['customer_name']}</td>";
    echo "<td>{$row_view['mobile_no']}</td>";
    echo "<td>{$row_view['narration']}</td>";
    echo "<td>{$row_view['sub_total']}</td>";
    echo "<td>{$row_view['pay']}</td>";
    echo "<td>{$row_view['payment_type']}</td>";
    echo "</tr>";
}

// Sending HTML response back to AJAX request
// Display total amount row
echo "<tr>";
echo "<td colspan='5'></td>";
echo "<td><strong>Total:</strong></td>";
echo "<td><strong>$totalAmount</strong></td>";
echo "<td></td>";
echo "</tr>";
?>
