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
                        <div class="form-section-header">Income Report </div>
                    </div>
                    <form action="" method="post" name="frmIncomeReport" id="frmIncomeReport">
                        <!-- Row start -->
                        <div class="row gutters">

                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="income_type" id="income_type">
                                        <option value="" selected>Select</option>
                                        <?php
                                        $sql_income_type = "SELECT * FROM tbl_income_type";
                                        $rs_income_type = mysqli_query($con, $sql_income_type);
                                        if (!$rs_income_type) {
                                            die('No Income Type Found.' . mysqli_error($con));
                                        }
                                        while ($row_income_type = mysqli_fetch_array($rs_income_type)) {
                                        ?>
                                            <option value="<?php echo $row_income_type['income_type_id']; ?>"><?php echo $row_income_type['income_type']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="field-placeholder">Income Type</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="payment_type" id="payment_type">
                                        <option value="" selected>Select</option>
                                        <?php
                                        $sql_payment_type = "SELECT * FROM tbl_payment_type";
                                        $rs_payment_type = mysqli_query($con, $sql_payment_type);
                                        if (!$rs_payment_type) {
                                            die('No Payment Type Found.' . mysqli_error($con));
                                        }
                                        while ($row_payment_type = mysqli_fetch_array($rs_payment_type)) {
                                        ?>
                                            <option value="<?php echo $row_payment_type['payment_type_id']; ?>"><?php echo $row_payment_type['payment_type']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="field-placeholder">Payemnt Type</div>
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
                            <div class="col-xl-1 col-lg-12 col-md-12 col-sm-12 col-12" style="margin: 1%;" >
                                <input type="hidden" name="income_id" id="income_id">
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
                    <div class="form-section-header">Income Report Data</div>
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
                                    <th>Income Type</th>
                                    <th>Payment Type</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewIncome()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) 
                                {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                // $counter = 0;
                                // $totalAmount = 0;
                                while ($row_view = mysqli_fetch_array($rs_view)) 
                                {
                                    // $totalAmount += $row_view['income_amount'];
                                ?>
                                    <tr>

                                        <!-- <td><?php echo ++$counter; ?></td> -->
                                        <td><?php echo $row_view['income_invoice_no']; ?></td>
                                        <td><?php echo $row_view['income_invoice_date']; ?></td>
                                        <td><?php echo $row_view['income_type']; ?></td>
                                        <td><?php echo $row_view['payment_type']; ?></td>
                                        <td><?php echo $row_view['income_description']; ?></td>
                                        <td><?php echo $row_view['income_amount']; ?></td>


                                        <?php
                                            }
                                        ?>
                                    </tr>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><strong>Full Income Total:</strong></td>
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
$(document).ready(function(){
    $('#btn_search').click(function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var income_type = $('#income_type').val();
        var payment_type = $('#payment_type').val();

        // Send AJAX request
        $.ajax({
            url: 'search_income.php',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                income_type: income_type,
                payment_type: payment_type
            },
            success: function(response) {
                // Replace table body with returned data
                $('tbody').html(response);
            }
        });
    });
});
</script>

<?php
include_once('footer.php');
?>
