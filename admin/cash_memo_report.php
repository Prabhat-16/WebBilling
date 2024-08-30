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
                        <div class="form-section-header">Cash Memo Report </div>
                    </div>
                    <form action="" method="post" name="frmCashMemoReport" id="frmCashMemoReport">
                        <!-- Row start -->
                        <div class="row gutters">
                       

                            
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="customer_name" id="customer_name">
                                        <option value="" selected>Select</option>
                                        <?php
                                            $sql_party_name = "SELECT DISTINCT customer_name FROM tbl_cash_memo";
                                            $rs_party_name = mysqli_query($con,$sql_party_name);
                                            if(!$rs_party_name)
                                            {
                                                die('No Party Name.'.mysqli_error($con));
                                            }
                                            while($row_party_name = mysqli_fetch_array($rs_party_name))
                                            {
                                        ?>
                                        <option value="<?php echo $row_party_name['customer_name']; ?>"><?php echo $row_party_name['customer_name']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="field-placeholder">Party Name</div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <select name="mobile_no" id="mobile_no">
                                        <option value="" selected>Select</option>
                                        <?php
                                            $sql_party_mo = "SELECT DISTINCT mobile_no FROM tbl_cash_memo";
                                            $rs_party_mo = mysqli_query($con,$sql_party_mo);
                                            if(!$rs_party_mo)
                                            {
                                                die('No Mobike Found.'.mysqli_error($con));
                                            }
                                            while($row_mo = mysqli_fetch_array($rs_party_mo))
                                            {
                                        ?>  
                                        <option value="<?php echo $row_mo['mobile_no']; ?>"><?php echo $row_mo['mobile_no']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="field-placeholder">Mobile No</div>
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
                                    <th>Customer Name</th>
                                    <th>Mobile No</th>
                                    <th>Description</th>
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
                                if (!$rs_view) 
                                {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                // $counter = 0;
                                // $totalAmount = 0;
                                while ($row_view = mysqli_fetch_array($rs_view)) 
                                {
                                    // $totalAmount += $row_view['pay'];
                                ?>
                                    <tr>

                                        <!-- <td><?php echo ++$counter; ?></td> -->
                                        <td><?php echo $row_view['invoice_no']; ?></td>
                                        <td><?php echo $row_view['cash_memo_date']; ?></td>
                                        <td><?php echo $row_view['customer_name']; ?></td>
                                        <td><?php echo $row_view['mobile_no']; ?></td>
                                        <td><?php echo $row_view['narration']; ?></td>
                                        <td><?php echo $row_view['sub_total']; ?></td>
                                        <td><?php echo $row_view['pay']; ?></td>
                                        <td><?php echo $row_view['payment_type']; ?></td>


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
$(document).ready(function(){
    $('#btn_search').click(function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var customer_name = $('#customer_name').val();
        var mobile_no = $('#mobile_no').val();

        // Send AJAX request
        $.ajax({
            url: 'search_cash_memo.php',
            method: 'POST',
            data: {
                start_date: start_date,
                end_date: end_date,
                customer_name: customer_name,
                mobile_no: mobile_no
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

