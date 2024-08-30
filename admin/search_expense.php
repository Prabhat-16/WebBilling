<?php 
include_once('../connection.php');

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$expense_type = $_POST['expense_type'];
$payment_type = $_POST['payment_type'];

$sql_expense_report = "SELECT e.*, pt.payment_type as payment_type, et.expense_type as expense_type
                       FROM tbl_expense e
                       LEFT JOIN tbl_payment_type pt ON e.payment_type_id = pt.payment_type_id
                       LEFT JOIN tbl_expense_type et ON e.expense_type_id = et.expense_type_id
                       WHERE 1=1";

if ($start_date !== '') 
{
    $sql_expense_report .= " AND e.expense_invoice_date >= '$start_date'";
}
if ($end_date !== '') 
{
    $sql_expense_report .= " AND e.expense_invoice_date <= '$end_date'";
}
if ($expense_type !== '') 
{
    $sql_expense_report .= " AND e.expense_type_id = $expense_type";
}
if ($payment_type !== '') 
{
    $sql_expense_report .= " AND e.payment_type_id = $payment_type";
}

$rs_view = mysqli_query($con, $sql_expense_report);
if (!$rs_view) 
{
    die('Error executing query: ' . mysqli_error($con));
}

// Display the results
// $counter = 0;
$totalAmount = 0; 
while ($row_view = mysqli_fetch_array($rs_view)) 
{
    // $counter++;
    $totalAmount += $row_view['expense_amount']; // Add expense amount to total
    echo "<tr>";
    // echo "<td>$counter</td>";
    echo "<td>{$row_view['expense_invoice_no']}</td>";
    echo "<td>{$row_view['expense_invoice_date']}</td>";
    echo "<td>{$row_view['expense_type']}</td>";
    echo "<td>{$row_view['payment_type']}</td>";
    echo "<td>{$row_view['expense_description']}</td>";
    echo "<td>{$row_view['expense_amount']}</td>";
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
