<?php
include_once('../connection.php');

    // Check if all required keys are present in the $_POST array
    if (isset($_POST['invoice_type'], $_POST['party_id'], $_POST['party_group'])) 
    {
        $invoice_type = $_POST['invoice_type'];
        $party_id = $_POST['party_id'];
        $party_group = $_POST['party_group'];

        // Determine the table name based on party group and invoice type
        $table_name = '';

        if ($party_group === 'Supplier') {
            $table_name = ($invoice_type === 'Purchase Invoice') ? 'tbl_purchase_invoice' : 'tbl_purchase_return_invoice';
            $invoice_column = 'purchase_invoice_id';
        } elseif ($party_group === 'Customer') {
            $table_name = ($invoice_type === 'Sales Invoice') ? 'tbl_sales_invoice' : 'tbl_sales_return_invoice';
            $invoice_column = 'sales_invoice_id';
        } else {
            echo json_encode(['error' => 'Invalid party group']);
            exit;
        }

        // Prepare the SQL statement to fetch invoice numbers based on party id and invoice type
        $sql = "SELECT DISTINCT i.$invoice_column, i.invoice_no
                FROM $table_name AS i
                LEFT JOIN tbl_party AS p ON i.party_id = p.party_id
                WHERE p.party_id = ?";

        $stmt = $con->prepare($sql);

        // Bind the party_id parameter
        $stmt->bind_param("s", $party_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Fetch invoice numbers into an associative array
            $invoices = [];
            while ($row = $result->fetch_assoc()) {
                $invoices[] = [
                    'invoice_id' => $row[$invoice_column],
                    'invoice_no' => $row['invoice_no']
                ];
            }

            // Output the invoices as JSON
            echo json_encode($invoices);
        } else {
            echo json_encode(['error' => 'SQL execution failed']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Required fields are missing']);
    }
?>
