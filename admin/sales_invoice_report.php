<?php
include_once('header.php');
?>
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Sales Invoice Report </div>
                    </div>
                    <form action="" method="post" name="frmSalesInvoiceReport" id="frmSalesInvoiceReport">
                        <!-- Row start -->
                        <div class="row gutters">



                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="customer_name" id="customer_name">
                                        <option value="" selected>Select</option>
                                        <?php
                                                $sql_customer = "SELECT party_id , party_name FROM tbl_party WHERE party_type = 'Customer'";
                                                $rs_customer = mysqli_query($con,$sql_customer);
                                                if(!$rs_customer)
                                                {
                                                    die('No Customer Found.'.mysqli_error($con));
                                                }
                                                while($row_customer = mysqli_fetch_array($rs_customer))
                                                {
                                        ?>
                                            <option value="<?php echo $row_customer['party_name']; ?>"><?php echo $row_customer['party_name']; ?></option>
                                        <?php
                                                }
                                        ?>

                                    </select>
                                    <div class="field-placeholder">Customer Name</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="invoice_no" id="invoice_no">
                                        <option value="" selected>Select</option>
                                        <?php
                                            $sql_invoice = "SELECT invoice_no FROM tbl_sales_invoice";
                                            $rs_invoice = mysqli_query($con,$sql_invoice);
                                            if(!$rs_invoice)
                                            {
                                                die('No Invoice Found.'.mysqli_error($con));
                                            }
                                            while($row_invoice = mysqli_fetch_array($rs_invoice))
                                            {
                                        ?>
                                        <option value="<?php echo $row_invoice['invoice_no'] ?>"><?php echo $row_invoice['invoice_no']; ?></option>
                                        <?php
                                            }
                                        ?>

                                    </select>
                                    <div class="field-placeholder">Invoice No</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="status" id="status">
                                        <option value="" selected>Select</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partial">Partial</option>

                                    </select>
                                    <div class="field-placeholder">Status </div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="date" name="start_date" id="start_date">
                                    <div class="field-placeholder">Start - Date</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="date" name="end_date" id="end_date">
                                    <div class="field-placeholder">End - Date</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-2" style="margin:1%;">
                                <input type="hidden" name="cash_memo_id" id="cash_memo_id">
                                <button type="button" class="btn btn-primary" name="btn_search" id="btn_search"><i class="search icon icon-search1"></i>Search</button>
                            </div>


                        </div>
                        <!-- Row end -->
                    </form>
                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
    <!-- Row end -->
    <!-- Table for displaying search results -->

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


            <div class="card">
                <div class="card-header">
                    <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">expense Report Data</div>
                </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <!-- <th>SR.NO</th> -->
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Net Total</th>
                                    <th>Total Pay</th>
                                    <th>Due  Amount</th>
                                    <th>Pament Type</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "With id as(
                                    SELECT sot.sales_invoice_id, sot.invoice_no, sot.sales_date, sot.party_id, pt.party_name,sot.due_date, sot.due_days, sot.net_total, sot.narration ,sot.payment_type_id ,tpy.payment_type  
                                    FROM tbl_sales_invoice sot
                                    LEFT JOIN tbl_party pt ON sot.party_id = pt.party_id 
                                    LEFT JOIN tbl_payment_type tpy ON sot.payment_type_id = tpy.payment_type_id
                                    WHERE sot.financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default= 1)
                                    ),
                                    td as(
                                    SELECT sales_invoice_id, SUM(IFNULL(qty,0.00)) as qty, SUM(IFNULL(rate,0)) as rate
                                    FROM tbl_sales_invoice_detail
                                    WHERE sales_invoice_id IN (SELECT sales_invoice_id 
                                    FROM tbl_sales_invoice 
                                    WHERE financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year 
                                    WHERE is_default= 1))
                                    GROUP BY sales_invoice_id
                                    ),
                                    pld as(
                                    SELECT SUM(plt.credit) as paid_amount, plt.invoice_no, sot.sales_invoice_id 
                                    FROM  tbl_party_ledger plt
                                    LEFT JOIN tbl_sales_invoice sot ON plt.invoice_no = sot.invoice_no
                                    WHERE plt.party_type = 'Customer' AND plt.invoice_type = 0 
                                    AND plt.financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year 
                                    WHERE is_default= 1)
                                    GROUP BY plt.invoice_no, sot.sales_invoice_id
                                    ),
                                    st as (
                                    SELECT (CASE   
                                    WHEN pld.paid_amount = id.net_total THEN 'Paid' 
                                    WHEN pld.paid_amount = 0 THEN 'Unpaid' 
                                    WHEN pld.paid_amount < id.net_total and pld.paid_amount != 0 Then 'Partial' 
                                    END  ) as status, pld.sales_invoice_id FROM pld 
                                    LEFT JOIN id on pld.sales_invoice_id = id.sales_invoice_id
                                    ),
                                    pldate as (
                                    SELECT * FROM 
                                    tbl_party_ledger pl 
                                    WHERE party_type = 'Customer' AND credit > 0 AND 
                                    party_ledger_id = (SELECT MAX(party_ledger_id) 
                                    FROM tbl_party_ledger _pl 
                                    WHERE _pl.financial_year_id = (SELECT financial_year_id 
                                    FROM tbl_financial_year  WHERE is_default= 1) 
                                    AND _pl.party_type = 'Customer' AND _pl.credit > 0 AND _pl.invoice_no = pl.invoice_no)
                                    )
                                    SELECT ROW_NUMBER() OVER (ORDER BY td.sales_invoice_id DESC) AS PRNO, id.party_id, id.party_name, id.invoice_no, id.sales_date, id.due_date, id.due_days, id.net_total as total_amt, id.narration,id.payment_type_id,id.payment_type,
                                    pld.paid_amount as total_paid, st.status, (id.net_total - pld.paid_amount) as balance, 
                                    td.sales_invoice_id
                                    FROM td 
                                    LEFT JOIN id ON td.sales_invoice_id = id.sales_invoice_id
                                    LEFT JOIN pld ON td.sales_invoice_id = pld.sales_invoice_id
                                    LEFT JOIN pldate ON pld.sales_invoice_id = pldate.related_id
                                    LEFT JOIN st ON td.sales_invoice_id = st.sales_invoice_id
                                    WHERE (1=1)";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                // $counter = 0;
                                // $totalAmount = 0;
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                    // $totalAmount += $row_view['pay'];
                                ?>
                                    <tr>

                                        <!-- <td><?php echo ++$counter; ?></td> -->
                                        <td><?php echo $row_view['invoice_no']; ?></td>
                                        <td><?php echo $row_view['sales_date']; ?></td>
                                        <td><?php echo $row_view['party_name']; ?></td>
                                        <td><?php echo $row_view['total_amt']; ?></td>
                                        <td><?php echo $row_view['total_paid']; ?></td>
                                        <td><?php echo $row_view['balance']; ?></td>
                                        <td><?php echo $row_view['payment_type']; ?></td>
                                        <td><?php echo $row_view['status']; ?></td>


                                    <?php
                                }
                                    ?>
                                    </tr>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><strong>Full  Total:</strong></td>
                                    <td><strong><?php echo $totalAmount; ?></strong></td>
                                    <td></td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn_search').click(function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var customer_name = $('#customer_name').val();
            var invoice_no = $('#invoice_no').val();
            var status = $('#status').val();

            // Send AJAX request
            $.ajax({
                url: 'search_sales_invoice.php',
                method: 'POST',
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    customer_name: customer_name,
                    invoice_no: invoice_no,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    $('tbody').html(response);
                }
            });
        });
    });
</script>

<?php
include_once('footer.php');
?>