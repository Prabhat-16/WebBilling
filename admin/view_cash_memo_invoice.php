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
                    <h4>Cash Memo Invoice</h4>
                    <div class="text-end">
                        <a href="cash_memo_invoice.php" class="btn btn-light">Create Invoice</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th>
                                    <th>Customer Name </th>
                                    <th>Sub Total</th>
                                    <th>Total Pay</th>
                                    <th>Payment Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   // Fetching Financial Code
                                    $financialYearQuery = "SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1";
                                    $financialYearResult = mysqli_query($con, $financialYearQuery);

                                    if (!$financialYearResult) {
                                        die('Error: ' . mysqli_error($con));
                                    }

                                    $row_financial_year = mysqli_fetch_array($financialYearResult);
                                    $financial_year = $row_financial_year['financial_year_id'];

                                    $sql_view = "SELECT tcm.*, tpy.payment_type
                                                FROM tbl_cash_memo tcm
                                                LEFT JOIN tbl_payment_type tpy ON tcm.payment_type_id = tpy.payment_type_id
                                                WHERE tcm.financial_year_id = '$financial_year'
                                                ORDER BY invoice_no DESC;";
                                        $rs_view = mysqli_query($con, $sql_view);
                                        if (!$rs_view) {
                                            die('View Not Found.' . mysqli_error($con));
                                        }
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="actions">
                                                <a href="" id="<?php echo $row_view['cash_memo_id']; ?>" data-toggle="tooltip" class="btn_edit" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="" class="btn_delete" id="<?php echo $row_view['cash_memo_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                                <a href="#" class="btn_print" id="<?php echo $row_view['cash_memo_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $row_view['invoice_no']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_view['cash_memo_date']; ?>
                                        </td>
                                        <td><?php echo $row_view['customer_name']; ?></td>
                                        <td><?php echo $row_view['sub_total'] ?></td>
                                        <td><?php echo $row_view['pay']; ?></td>
                                        <td>
                                            <?php echo $row_view['payment_type']; ?>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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
<!-- Toast message -->
<div id="toastDeleted" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: fixed; top: 20px; right: 20px;">
    <div class="toast-header">
        <strong class="mr-auto">Success</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        Record deleted successfully.
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var cash_memo_id = $(this).attr("id");

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'cash_memo_delete.php',
                    data: {
                        'id': cash_memo_id,
                        'delete': 1
                    },
                    type: 'post',
                    success: function(output) {
                        // Show toast after successful deletion
                        $('#toastDeleted').toast('show');
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            } else {
                return false;
            }
        });

        $('.btn_edit').click(function(e) {
            e.preventDefault();
            var cash_memo_id = $(this).attr("id");
            
            if (confirm("Are you sure you want to edit this?")) {
                window.location = 'cash_memo_edit.php?id=' + cash_memo_id;
            } else {
                return false;
            }
        });
        $('.btn_print').click(function(e) {
            e.preventDefault();
            var cash_memo_id = $(this).attr("id");

            //  alert(cash_memo_id);

            if (confirm("Are you sure you want to Print this?")) 
        {
            window.location = 'cash_memo_generate_pdf.php?id=' + cash_memo_id;
        } else {
            return false;
        }
    });

    });
</script>

<?php
include_once('footer.php');
?>