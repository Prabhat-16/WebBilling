<?php
include_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoice_no = $_POST['invoice_no'];
    $party_group = $_POST['party_group'];
    $party_id = $_POST['party_id'];

    // Initialize the table name variable
    $table_name = "";
    $ledger_table_name = "tbl_party_ledger";  

    if ($party_group === 'Customer') {
        $table_name = "tbl_sales_invoice";
    } elseif ($party_group === 'Supplier') {
        $table_name = "tbl_purchase_invoice";
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid party group']);
        exit;
    }

    // Fetch net total from the respective table
    $sql = "SELECT net_total 
            FROM " . $table_name . " 
            WHERE invoice_no = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $invoice_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $net_total = $row['net_total'];

        // Fetch credit or debit from the party ledger using JOIN
        $sql_ledger = "SELECT SUM(l.credit) AS total_credit, SUM(l.debit) AS total_debit 
                       FROM " . $ledger_table_name . " AS l
                       INNER JOIN tbl_party AS p ON l.party_id = p.party_id
                       WHERE p.party_id = ?";

        $stmt_ledger = $con->prepare($sql_ledger);
        $stmt_ledger->bind_param("s", $party_id);
        $stmt_ledger->execute();
        $result_ledger = $stmt_ledger->get_result();

        if ($row_ledger = $result_ledger->fetch_assoc()) {
            if ($party_group === 'Customer') {
                $total_amount = $row_ledger['total_credit'];
            } elseif ($party_group === 'Supplier') {
                $total_amount = $row_ledger['total_debit'];
            }

            // Calculate the amount by subtracting total credit or debit from net total
            $amount = $net_total - $total_amount;

            echo json_encode(['status' => 'success', 'amount' => $amount]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No ledger entries found for the party']);

        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invoice not found']);
    }
}
?>
