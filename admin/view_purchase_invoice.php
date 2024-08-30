<?php
include_once('header.php');

?>
<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <div class="card-header-lg">
                    <h4>View Invoice</h4>
                    <div class="text-end">
                        <a href="purchase_invoice.php" class="btn btn-light">Create Invoice</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                    <!-- <button class="btn btn-light" onclick="printInvoice()">Print</button> -->
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Party Name </th>
                                    <th>Sub Total</th>
                                    <th>Total Pay</th>
                                    <th>Due Amount</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_view = "With id as(
                                    SELECT pot.purchase_invoice_id, pot.invoice_no, pot.purchase_date, pot.party_id, pt.party_name,   pot.due_date, pot.due_days, pot.net_total, pot.narration ,pot.payment_type_id ,tpy.payment_type  
                                    FROM tbl_purchase_invoice pot
                                    LEFT JOIN tbl_party pt ON pot.party_id = pt.party_id 
                                    LEFT JOIN tbl_payment_type tpy ON pot.payment_type_id = tpy.payment_type_id
                                    WHERE pot.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default= 1)
                                    ),
                                    td as(
                                    SELECT purchase_invoice_id, SUM(IFNULL(qty,0.00)) as qty, SUM(IFNULL(rate,0)) as rate
                                    FROM tbl_purchase_invoice_detail
                                    WHERE purchase_invoice_id IN (SELECT purchase_invoice_id 
                                    FROM tbl_purchase_invoice 
                                    WHERE financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year 
                                    WHERE is_default= 1))
                                    GROUP BY purchase_invoice_id
                                    ),
                                    pld as(
                                    SELECT SUM(plt.debit) as paid_amount, plt.invoice_no, pot.purchase_invoice_id 
                                    FROM  tbl_party_ledger plt
                                    LEFT JOIN tbl_purchase_invoice pot ON plt.invoice_no = pot.invoice_no
                                    WHERE plt.party_type = 'Supplier' AND plt.invoice_type = 0 
                                    AND plt.financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year 
                                    WHERE is_default= 1)
                                    GROUP BY plt.invoice_no, pot.purchase_invoice_id
                                    ),
                                    st as (
                                    SELECT (CASE   
                                    WHEN pld.paid_amount = id.net_total THEN 'Paid' 
                                    WHEN pld.paid_amount = 0 THEN 'Unpaid' 
                                    WHEN pld.paid_amount < id.net_total and pld.paid_amount != 0 Then 'Partial' 
                                    END  ) as status, pld.purchase_invoice_id FROM pld 
                                    LEFT JOIN id on pld.purchase_invoice_id = id.purchase_invoice_id
                                    ),
                                    pldate as (
                                    SELECT * FROM 
                                    tbl_party_ledger pl 
                                    WHERE party_type = 'Supplier' AND debit > 0 AND 
                                    party_ledger_id = (SELECT MAX(party_ledger_id) 
                                    FROM tbl_party_ledger _pl 
                                    WHERE _pl.financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year  WHERE is_default= 1) 
                                    AND _pl.party_type = 'Supplier' AND _pl.debit > 0 AND _pl.invoice_no = pl.invoice_no)
                                    )
                                    SELECT ROW_NUMBER() OVER (ORDER BY td.purchase_invoice_id DESC) AS PRNO, id.party_id, id.party_name, id.invoice_no, id.purchase_date, id.due_date, id.due_days, id.net_total as total_amt, id.narration,id.payment_type_id,id.payment_type,
                                    pld.paid_amount as total_paid, st.status, (id.net_total - pld.paid_amount) as balance, 
                                    td.purchase_invoice_id
                                    FROM td 
                                    LEFT JOIN id ON td.purchase_invoice_id = id.purchase_invoice_id
                                    LEFT JOIN pld ON td.purchase_invoice_id = pld.purchase_invoice_id
                                    LEFT JOIN pldate ON pld.purchase_invoice_id = pldate.related_id
                                    LEFT JOIN st ON td.purchase_invoice_id = st.purchase_invoice_id
                                    WHERE (1=1)";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) 
                                {
                                    die('No Record Found.' . mysqli_error($con));
                                }   
                                while ($row_view = mysqli_fetch_array($rs_view)) 
                                {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="actions">
                                                <a href="#" class="btn_edit" id="<?php echo $row_view['purchase_invoice_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="#" class="btn_delete" id="<?php echo $row_view['purchase_invoice_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                                <a href="#" class="btn_print" id="<?php echo $row_view['purchase_invoice_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row_view['invoice_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_view['purchase_date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_view['party_name']; ?>
                                        </td>
                                        <td><?php echo $row_view['total_amt']; ?>
                                        </td>
                                        <td><?php echo $row_view['total_paid']; ?></td>
                                        <td><?php echo $row_view['balance']; ?></td>
                                        <td>
                                            <?php echo $row_view['payment_type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_view['status']; ?>
                                        </td>
                                    <?php
                                }
                                    ?>

                                    </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- Row end -->

</div>
<!-- Content wrapper end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var purchase_invoice_id = $(this).attr("id");

            // alert(purchase_invoice_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'purchase_invoice_delete.php',
                    data: {
                        'id': purchase_invoice_id,
                        'delete': 1
                    },
                    type: 'post',
                    success: function(output) {
                        window.location.reload();
                    }
                });
            } else {
                return false;
            }
        });

        $('.btn_edit').click(function(e) {
        e.preventDefault();
        var purchase_invoice_id  = $(this).attr("id");
            
        if (confirm("Are you sure you want to edit this?")) 
        {
            window.location = 'purchase_invoice_edit.php?id=' + purchase_invoice_id;
        } else {
            return false;
        }
    });
    $('.btn_print').click(function(e) {
            e.preventDefault();
            var purchase_invoice_id = $(this).attr("id");

            // alert(purchase_invoice_id);

            if (confirm("Are you sure you want to Print this?")) 
        {
            window.location = 'purchase_generate_pdf.php?id=' + purchase_invoice_id;
        } else {
            return false;
        }
    });
});

    function validate() {
        var size_name = document.getElementById("size_name").value;

        if (size_name == "") {
            alert('Please Enter Size .');
            return false;
        }

        return true;
    }
</script>
<?php
include_once('footer.php');
?>