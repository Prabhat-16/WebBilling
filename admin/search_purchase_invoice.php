<?php
include_once('../connection.php');

// Receive parameters sent by AJAX
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$supplier_name = $_POST['supplier_name'];
$invoice_no = $_POST['invoice_no'];
$status = $_POST['status'];

// Construct SQL query to select from the view
$sql = "WITH id AS (
    SELECT pot.purchase_invoice_id, pot.invoice_no, pot.purchase_date, pot.party_id, pt.party_name, pot.due_date, pot.due_days, pot.net_total, pot.narration, pot.payment_type_id, tpy.payment_type  
    FROM tbl_purchase_invoice pot
    LEFT JOIN tbl_party pt ON pot.party_id = pt.party_id 
    LEFT JOIN tbl_payment_type tpy ON pot.payment_type_id = tpy.payment_type_id
    WHERE pot.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default=1)
),
td AS (
    SELECT purchase_invoice_id, SUM(IFNULL(qty,0.00)) AS qty, SUM(IFNULL(rate,0)) AS rate
    FROM tbl_purchase_invoice_detail
    WHERE purchase_invoice_id IN (SELECT purchase_invoice_id 
        FROM tbl_purchase_invoice 
        WHERE financial_year_id = (SELECT financial_year_id 
            FROM tbl_financial_year 
            WHERE is_default=1))
    GROUP BY purchase_invoice_id
),
pld AS (
    SELECT SUM(plt.debit) AS paid_amount, plt.invoice_no, pot.purchase_invoice_id 
    FROM tbl_party_ledger plt
    LEFT JOIN tbl_purchase_invoice pot ON plt.invoice_no = pot.invoice_no
    WHERE plt.party_type = 'Supplier' AND plt.invoice_type = 0 
        AND plt.financial_year_id = (SELECT financial_year_id 
            FROM tbl_financial_year 
            WHERE is_default=1)
    GROUP BY plt.invoice_no, pot.purchase_invoice_id
),
st AS (
    SELECT (CASE   
            WHEN pld.paid_amount = id.net_total THEN 'Paid' 
            WHEN pld.paid_amount = 0 THEN 'Unpaid' 
            WHEN pld.paid_amount < id.net_total AND pld.paid_amount != 0 THEN 'Partial' 
            END) AS status, pld.purchase_invoice_id 
    FROM pld 
    LEFT JOIN id ON pld.purchase_invoice_id = id.purchase_invoice_id
),
pldate AS (
    SELECT * FROM 
    tbl_party_ledger pl 
    WHERE party_type = 'Supplier' AND debit > 0 AND 
    party_ledger_id = (SELECT MAX(party_ledger_id) 
        FROM tbl_party_ledger _pl 
        WHERE _pl.financial_year_id = (SELECT financial_year_id 
            FROM tbl_financial_year  
            WHERE is_default=1) 
            AND _pl.party_type = 'Supplier' AND _pl.debit > 0 AND _pl.invoice_no = pl.invoice_no)
)
SELECT ROW_NUMBER() OVER (ORDER BY td.purchase_invoice_id DESC) AS PRNO, id.party_id, id.party_name, id.invoice_no, id.purchase_date, id.due_date, id.due_days, id.net_total AS total_amt, id.narration, id.payment_type_id, id.payment_type,
    pld.paid_amount AS total_paid, st.status, (id.net_total - pld.paid_amount) AS balance, 
    td.purchase_invoice_id
FROM td 
LEFT JOIN id ON td.purchase_invoice_id = id.purchase_invoice_id
LEFT JOIN pld ON td.purchase_invoice_id = pld.purchase_invoice_id
LEFT JOIN pldate ON pld.purchase_invoice_id = pldate.related_id
LEFT JOIN st ON td.purchase_invoice_id = st.purchase_invoice_id
WHERE 1=1";

if (!empty($start_date)) 
{
    $sql .= " AND id.purchase_date >= '$start_date'";
}

if (!empty($end_date)) 
{
    $sql .= " AND id.purchase_date <= '$end_date'";
}

if (!empty($supplier_name)) 
{
    $sql .= " AND id.party_name = '$supplier_name'";
}

if (!empty($invoice_no)) {
    $sql .= " AND id.invoice_no = '$invoice_no'";
}

if (!empty($status)) 
{
    $sql .= " AND st.status = '$status'";
}

// Execute SQL query
$rs_view = mysqli_query($con, $sql);

// Check for errors
if (!$rs_view) 
{
    die('Error: ' . mysqli_error($con));
}

// Echo out HTML for table rows with fetched data
$totalAmount = 0;
while ($row_view = mysqli_fetch_array($rs_view))
 {
    $totalAmount += $row_view['total_paid']; 
    echo "<tr>";
    echo "<td>{$row_view['invoice_no']}</td>";
    echo "<td>{$row_view['purchase_date']}</td>";
    echo "<td>{$row_view['party_name']}</td>";
    // echo "<td>{$row_view['net_total']}</td>";
    echo "<td>{$row_view['total_amt']}</td>";
    echo "<td>{$row_view['total_paid']}</td>";
    echo "<td>{$row_view['balance']}</td>";
    echo "<td>{$row_view['payment_type']}</td>";
    echo "<td>{$row_view['status']}</td>";
    echo "</tr>";
}
//Sending HTML response back to AJAX request
// Display total amount row
echo "<tr>";
echo "<td colspan='3'></td>";
echo "<td><strong>Total:</strong></td>";
echo "<td><strong>$totalAmount</strong></td>";
echo "<td></td>";
echo "</tr>";
?>
