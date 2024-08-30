<?php 
include_once('../connection.php');

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$income_type = $_POST['income_type'];
$payment_type = $_POST['payment_type'];

$sql_income_report = "SELECT i.*, pt.payment_type as payment_type, it.income_type as income_type
                       FROM tbl_income i
                       LEFT JOIN tbl_payment_type pt ON i.payment_type_id = pt.payment_type_id
                       LEFT JOIN tbl_income_type it ON i.income_type_id = it.income_type_id
                       WHERE 1=1";

if ($start_date !== '') 
{
    $sql_income_report .= " AND i.income_invoice_date >= '$start_date'";
}
if ($end_date !== '') 
{
    $sql_income_report .= " AND i.income_invoice_date <= '$end_date'";
}
if ($income_type !== '') 
{
    $sql_income_report .= " AND i.income_type_id = $income_type";
}
if ($payment_type !== '') 
{
    $sql_income_report .= " AND i.payment_type_id = $payment_type";
}

$rs_view = mysqli_query($con, $sql_income_report);
if (!$rs_view) 
{
    die('Error executing query: ' . mysqli_error($con));
}

// Display the results
$counter = 0;
$totalAmount = 0; 
while ($row_view = mysqli_fetch_array($rs_view)) 
{
    // $counter++;
    $totalAmount += $row_view['income_amount']; // Add income amount to total
    echo "<tr>";
    // echo "<td>$counter</td>";
    echo "<td>{$row_view['income_invoice_no']}</td>";
    echo "<td>{$row_view['income_invoice_date']}</td>";
    echo "<td>{$row_view['income_type']}</td>";
    echo "<td>{$row_view['payment_type']}</td>";
    echo "<td>{$row_view['income_description']}</td>";
    echo "<td>{$row_view['income_amount']}</td>";
    echo "</tr>";
}

// Display total amount row
echo "<tr>";
echo "<td colspan='4'></td>";
echo "<td><strong>Total:</strong></td>";
echo "<td><strong>$totalAmount</strong></td>";
echo "<td></td>";
echo "</tr>";
?>
