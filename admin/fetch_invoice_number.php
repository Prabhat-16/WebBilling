<?php
     include_once('../connection.php');
// Fetch invoice numbers from tbl_purchase_invoice
if(isset($_POST['party_group'])) {
    $party_group = $_POST['party_group'];
    // Fetch invoice number from tbl_purchase_invoice
    $sql_purchase = "SELECT invoice_no FROM tbl_purchase_invoice WHERE party_group = ?";
    $stmt_purchase = $con->prepare($sql_purchase);
    $stmt_purchase->bind_param("s", $party_group);
    $stmt_purchase->execute();
    $result_purchase = $stmt_purchase->get_result();
    $invoice_numbers = array();
    if ($result_purchase->num_rows > 0) {
        while($row = $result_purchase->fetch_assoc()) {
            $invoice_numbers[] = $row['invoice_no'];
        }
    }

    // Fetch invoice numbers from tbl_sales_invoice
    $sql_sales = "SELECT invoice_no FROM tbl_sales_invoice WHERE party_group = ?";
    $stmt_sales = $con->prepare($sql_sales);
    $stmt_sales->bind_param("s", $party_group);
    $stmt_sales->execute();
    $result_sales = $stmt_sales->get_result();
    if ($result_sales->num_rows > 0) {
        while($row = $result_sales->fetch_assoc()) {
            $invoice_numbers[] = $row['invoice_no'];
        }
    }

    // Encode and return the array of invoice numbers
    echo json_encode($invoice_numbers);
}


?>