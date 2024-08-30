<?php
include_once('header.php');

if (isset($_POST['BtnInvoice'])) 
{
    // echo "Clicked";

    // Fetch the maximum invoice number from the database
    $invoiceNumberQuery = "Select IFNull(Max(invoice_no),0)+1 as invoice_no From tbl_cash_memo WHERE financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1)";
    $invoiceNumberResult = mysqli_query($con, $invoiceNumberQuery);

    if (!$invoiceNumberResult) 
    {
        die('Error: ' . mysqli_error($con));
    }

    $row_invoice = mysqli_fetch_array($invoiceNumberResult);
    $invoice_no = $row_invoice['invoice_no'];

    //Fetching Financial Code
    $financialYearQuery = "SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1";
    $financialYearResult = mysqli_query($con, $financialYearQuery);

    if (!$financialYearResult) 
    {
        die('Error: ' . mysqli_error($con));
    }
    $row_financial_year = mysqli_fetch_array($financialYearResult);
    $financial_year = $row_financial_year['financial_year_id'];

    $description = 'CashMemo:Invoice_no:'.$invoice_no;

    if ($_POST['cash_memo_id'] == "") 
    {
        //Insert Into Cash Memo
        $sql_cash_memo = "INSERT INTO tbl_cash_memo(customer_name,mobile_no,invoice_no,cash_memo_date,narration,sub_total,pay,place_of_supply_id,payment_type_id,financial_year_id,created_by) VALUE ('" . $_POST['customer_name'] . "','" . $_POST['mobile_no'] . "','" . $invoice_no . "','" . $_POST['cash_memo_date'] . "','" . $_POST['narration'] . "','" . $_POST['sub_total'] . "','" . $_POST['pay'] . "','" . $_POST['state'] . "','" . $_POST['payment_type'] . "','" . $financial_year . "','" . $_SESSION['user_id'] . "')";
        // echo $sql_cash_memo;

        $rs_cash_memo = mysqli_query($con, $sql_cash_memo);
        $last_id = mysqli_insert_id($con);
        // echo $last_id; 
        if (!$rs_cash_memo) 
        {
            die('No Cash Memo Inserted.' . mysqli_error($con));
        }
        if (isset($_POST['quantity'][1])) 
        {
            $number = count($_POST['quantity']);
            // echo  $number;
        } 
            else 
        {
            $number = 1;
        }
        if ($number > 0) 
        {
            for ($i = 0; $i < $number; $i++) 
            {
                //Insert Into Cash Memo Detail
                $sql_cash_memo_detail = "INSERT INTO tbl_cash_memo_detail(cash_memo_id,product_id,qty,rate,discount_per,discount_amt,gst_per,gst_amt,financial_year_id) VALUE ('" . $last_id . "','" . $_POST['product_id'][$i] . "','" . $_POST['quantity'][$i] . "','" . $_POST['rate'][$i] . "','" . $_POST['discount_per'][$i] . "','" . $_POST['discount_amt'][$i] . "','" . $_POST['gst_per'][$i] . "','" . $_POST['gst_amt'][$i] . "','" . $financial_year . "')";

                // echo$sql_cash_memo_detail ;
                $rs_cash_memo_detail = mysqli_query($con, $sql_cash_memo_detail);
                if (!$rs_cash_memo_detail) 
                {
                    die('No Cash Memo Detail Inserted.' . mysqli_error($con));
                }
            }
        }

        //Insert Into Company Ledger
        $sql_company_cash_memo_ledger = "INSERT INTO tbl_company_ledger(related_id,related_obj,description,credit,debit,company_ledger_date,financial_year_id) VALUE ('" . $last_id . "','CashMemo','" . $description . "','0.00','" . $_POST['pay'] . "','" . $_POST['cash_memo_date'] . "','" . $financial_year . "')";
        $rs_copany_cash_memo_ledger = mysqli_query($con, $sql_company_cash_memo_ledger);
        if (!$rs_copany_cash_memo_ledger) 
        {
            die('Not Inserted Company Ledger');
        }
    }
    echo "<script>window.location = 'view_cash_memo_invoice.php';</script>";
    
}
?>
<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header-lg">
                    <h4>Cash Memo Invoice</h4>
                    <div class="text-end">
                        <a href="view_cash_memo_invoice.php" class="btn btn-light">View Invoice</a>
                        
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="CashMemoInvoice" id="CashMemoInvoice">

                        <!-- Row start -->
                        <div class="row justify-content-between">

                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">

                                <!-- Row start -->
                                <div class="row gutters">

                                    <div class="col-12">
                                        <div class="form-section-header light-bg">Party Details</div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="text" name="customer_name" id="customer_name">
                                            <div class="field-placeholder">Party Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="number" name="mobile_no" id="mobile_no">
                                            <div class="field-placeholder">Customer Mobile No</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <textarea class="form-control" rows="2" name="narration" id="narration"></textarea>
                                            <div class="field-placeholder">Narration</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                </div>
                                <!-- Row end -->

                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-7 col-sm-7 col-12">

                                <!-- Row start -->
                                <div class="row gutters">

                                    <div class="col-12">
                                        <div class="form-section-header light-bg">Date and Invoice Number</div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input type="date" class="form-control " name="cash_memo_date" id="cash_memo_date" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <div class="field-placeholder">Invoice Date</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <?php
                                            // Fetch the maximum invoice number from the database
                                            $invoiceNumberQuery = "Select IFNull(Max(invoice_no),0)+1 as invoice_no From tbl_cash_memo WHERE financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1)";
                                            $invoiceNumberResult = mysqli_query($con, $invoiceNumberQuery);

                                            if (!$invoiceNumberResult) {
                                                die('Error: ' . mysqli_error($con));
                                            }

                                            $row_invoice = mysqli_fetch_array($invoiceNumberResult);
                                            $invoice_no = $row_invoice['invoice_no'];
                                            ?>
                                            <input type="number" name="invoice_no" id="invoice_no" class="form-control" value="<?php echo $row_invoice['invoice_no']; ?>" readonly>
                                            <div class="field-placeholder">Invoice No</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <select class="select-single js-states" title="Select Term" data-live-search="true" name="state" id="state">
                                                    <option value="" selected>--Select--</option>
                                                    <?php
                                                    $sql_state = "SELECT * FROM tbl_state";
                                                    $rs_state = mysqli_query($con, $sql_state);
                                                    if (!$rs_state) {
                                                        die('No State Found.' . mysqli_error($con));
                                                    }
                                                    while ($row_state = mysqli_fetch_array($rs_state)) {
                                                    ?>
                                                        <option value="<?php echo $row_state['state_id'] ?>"><?php echo $row_state['state_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="field-placeholder">State</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                </div>
                                <!-- Row end -->

                            </div>

                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7" class="pt-3 pb-3">Invoice Details</th>
                                            </tr>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>G Total</th>
                                                <th>Discount %</th>
                                                <th>Discount Amt</th>
                                                <th>GST %</th>
                                                <th>GST Amt</th>
                                                <th>Amount (Net)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody id="dynamic_field">
                                            <tr class="static-row" id="row0">
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <select class="" data-live-search="true" id="product_id" name="product_id[]">
                                                            <option>Select Item</option>
                                                            <?php
                                                            $sql_item = "SELECT * FROM tbl_item";
                                                            $rs_item = mysqli_query($con, $sql_item);
                                                            if (!$rs_item) {
                                                                die('No Item Found.' . mysqli_error($con));
                                                            }
                                                            while ($row_item = mysqli_fetch_array($rs_item)) {
                                                            ?>
                                                                <option value="<?php echo $row_item['item_id']; ?>"><?php echo $row_item['item_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                    <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control gtotal" name="gtotal[]" id="gtotal" readonly onchange="calculateRow() ;">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" placeholder="%" onchange="calculateRow() ;">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control discount_amt" name="discount_amt[]" id="discount_amt" readonly>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <select class="form-control gst_per" name="gst_per[]" id="gst_per" placeholder="%" onchange="calculateRow() ;">
                                                            <option value=""selected>Select</option>
                                                            <?php
                                                                $sql_gst_slab = "SELECT * FROM tbl_gst_slab";
                                                                $rs_gst_slab = mysqli_query($con,$sql_gst_slab);
                                                                if(!$rs_gst_slab)
                                                                {
                                                                    die('No Record Found.'.mysqli_error($con));
                                                                }
                                                                while($row_gst_slab = mysqli_fetch_array($rs_gst_slab))
                                                                {
                                                            ?>
                                                            <option value="<?php echo $row_gst_slab['igst']; ?>"><?php echo $row_gst_slab['igst']; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                    </select>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control gst_amt" name="gst_amt[]" id="gst_amt" readonly>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control amount" placeholder="0.00" name="amount[]" id="amount" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        <input type="hidden" name="cash_memo_detail_id" id="cash_memo_detail_id">
                                                        <button class="btn btn-light">
                                                            <i class="icon-trash-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tr>
                                            <td>
                                                <button class="btn btn-light" id="addNewBtn">
                                                    Add New
                                                </button>
                                            </td>
                                            <td colspan="9">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">&nbsp;</td>
                                            <td colspan="2">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper">
                                                        <div class="input-group">
                                                            <input class="form-control" readonly type="number" name="sub_total" id="sub_total" placeholder="0.00">
                                                        </div>
                                                        <div class="field-placeholder">Sub Total</div>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper">
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="pay" id="pay" placeholder="0.00">
                                                        </div>
                                                        <div class="field-placeholder">Pay</div>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper">
                                                        <select class="select-single js-states" title="Select Term" data-live-search="true" name="payment_type" id="payment_type">
                                                            <option value="" selected>--Select--</option>
                                                            <?php
                                                            $sql_payment_type = "SELECT * FROM tbl_payment_type";
                                                            $rs_payment_type = mysqli_query($con, $sql_payment_type);
                                                            if (!$rs_payment_type) 
                                                            {
                                                                die('No Payment Type Found.' . mysqli_error($con));
                                                            }
                                                            while ($row_payment_type = mysqli_fetch_array($rs_payment_type)) 
                                                            {
                                                            ?>
                                                                <option value="<?php echo $row_payment_type['payment_type_id']; ?>"><?php echo $row_payment_type['payment_type']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="field-placeholder">Payment Type</div>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- Row end -->

                        <!-- Row start -->
                        <div class="row gutters">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-actions-footer">
                                    <div class="text-end">
                                        <input type="hidden" name="cash_memo_id" id="cash_memo_id" />
                                        <button type="submit" name="BtnInvoice" id="BtnInvoice" class="btn btn-primary ms-1">Create Invoice</button>
                                    </div>
                                </div>
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

</div>
<!-- Modal -->


<!-- Content wrapper end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">toastr.success('Have Fun')</script>

<script>
    $(document).ready(function() {

        // Define a function to handle the "Add New" button click
        $('#addNewBtn').click(function(event) {
            event.preventDefault();

            //  alert("Hello");

        // Append your HTML content to the table body with the id "dynamic_field"
         $('#dynamic_field').append('<tr class="static-row" id="row"> <td> <div class="field-wrapper m-0"> <select class="select-single js-states w-100 item_name" data-live-search="true" name="product_id[]" id="product_id"> <option value="" selected>--Select--</option> <?php $sql_item = "SELECT * FROM tbl_item"; $rs_item = mysqli_query($con, $sql_item); if (!$rs_item) { die('No Item Found.' . mysqli_error($con)); } while ($row_item = mysqli_fetch_array($rs_item)) { ?> <option value="<?php echo $row_item['item_id']; ?>"><?php echo $row_item['item_name']; ?></option> <?php } ?> </select> </div> </td> <td> <div class="field-wrapper m-0"> <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" onchange="calculateRow();"> </div> </td> <td> <div class="field-wrapper m-0"> <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" onchange="calculateRow();"> </div> </td> <td> <div class="field-wrapper m-0"> <input type="number" class="form-control gtotal" name="gtotal[]" id="gtotal" onchange="calculateRow() ;" readonly> </div> </td> <td> <div class="field-wrapper m-0"> <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" placeholder="%" onchange="calculateRow()"> </div> </td> <td> <div class="field-wrapper m-0"> <input type="number" class="form-control discount_amt" name="discount_amt[]" id="discount_amt" readonly> </div> </td> <td> <div class="field-wrapper m-0"> <select class="form-control gst_per" name="gst_per[]" id="gst_per" placeholder="%" onchange="calculateRow() ;"> <option value=""selected>Select</option> <?php $sql_gst_slab = "SELECT * FROM tbl_gst_slab"; $rs_gst_slab = mysqli_query($con,$sql_gst_slab); if(!$rs_gst_slab) { die('No Record Found.'.mysqli_error($con)); } while($row_gst_slab = mysqli_fetch_array($rs_gst_slab)) { ?> <option value="<?php echo $row_gst_slab['igst']; ?>"><?php echo $row_gst_slab['igst']; ?></option> <?php } ?> </select> </div> </td> <td> <div class="field-wrapper m-0"> <input type="number" class="form-control gst_amt" name="gst_amt[]" id="gst_amt" readonly> </div> </td> <td> <div class="field-wrapper m-0"> <div class="input-group"> <input type="number" class="form-control amount" placeholder="0.00" name="amount[]" id="amount" readonly> </div> </div> </td> <td> <div class="table-actions"> <a href="#" class="btn btn-light delete-btn"> <i class="icon-trash-2"></i> </a> </div> </td> </tr>');
        });


        //Code For Fetch rate 
        $(document).on('change', '#product_id', function() {
            var item_id = $(this).val();
            // alert(item_id);
            var currentRow = $(this).closest('tr');
           
            $.ajax({
                url: 'fetch_rate_gst.php',
                type: 'post',
                data: { item_id: item_id },
                dataType: 'json',
                success: function(response) 
                {
                    // alert(response.igst);
                    currentRow.find('#rate').val(response.rate);
                    currentRow.find('#gst_per').val(response.igst);
                    // Recalculate row values
                    calculateRow(currentRow);
                },
                error: function(xhr, status, error) 
                {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        });
        // Attach click event listener to dynamically added delete buttons
        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });
    });
</script>
<script>

    // Function to calculate subtotal for a row
    function calculateRow() {
        // alert("Hi");
        let item_quantity = document.getElementsByName("quantity[]");
        let item_rate = document.getElementsByName("rate[]");
        let item_discPer = document.getElementsByName("discount_per[]");
        let item_gstPer = document.getElementsByName("gst_per[]");
        let qty = 0.00;
        let rate = 0.00;
        let gtotal = 0.00;
        let discountPer = 0.00;
        let discountAmt = 0.00;
        let gstPer = 0.00;
        let gstAmt = 0.00;
        let netAmount = 0.00;
        let totalAmount = 0.00;

        let totalDiscountAmt = 0.00;

        for (let i = 0; i < item_quantity.length; i++) {
            // $('#rate').val(response.rate); 
            qty = parseFloat(item_quantity[i].value);
            // alert(qty);

            rate = parseFloat(item_rate[i].value);
            // alert(rate);

            gtotal = qty * rate;
            document.getElementsByName("gtotal[]")[i].value = gtotal.toFixed(2);

            discountPer = parseFloat(item_discPer[i].value);
            // alert(discountPer);
            discountAmt = ((gtotal * discountPer) / 100);
            document.getElementsByName("discount_amt[]")[i].value = discountAmt.toFixed(2);

            gstPer = parseFloat(item_gstPer[i].value);
            // alert(gstPer);
            // alert(gtotal - discountAmt);
            gstAmt = (((gtotal - discountAmt) * (gstPer)) / 100);
            document.getElementsByName("gst_amt[]")[i].value = gstAmt.toFixed(2);

            netAmount = (gtotal - discountAmt) + gstAmt;
            document.getElementsByName("amount[]")[i].value = netAmount.toFixed(2);

            totalAmount += netAmount;
            totalDiscountAmt += discountAmt;
        }
        $('#sub_total').val(totalAmount.toFixed(2));
        $('#discount_total').val(totalDiscountAmt.toFixed(2));
    }
</script>
<?php
include_once('footer.php');
?>