<?php
include_once('header.php');

if (isset($_POST['BtnInvoice'])) 
{
     echo "Hello";

    //Fetching Financial Code
    $financialYearQuery = "SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1";
    $financialYearResult = mysqli_query($con, $financialYearQuery);

    if (!$financialYearResult) 
    {
        die('Error: ' . mysqli_error($con));
    }
    $row_financial_year = mysqli_fetch_array($financialYearResult);
    $financial_year = $row_financial_year['financial_year_id'];



    //Insert Code For Cash Memo Return
    $sql_cash_memo_return = "INSERT INTO tbl_cash_memo_return (customer_name,mobile_no,invoice_no,cash_memo_return_date,narration,sub_total,pay,place_of_supply_id,payment_type_id,financial_year_id,created_by) VALUE ('" . $_POST['customer_name'] . "','" . $_POST['mobile_no'] . "','" . $_POST['invoice_no'] . "','" . $_POST['cash_memo_return_date'] . "','" . $_POST['narration'] . "','" . $_POST['sub_total'] . "','" . $_POST['pay'] . "','" . $_POST['state'] . "','" . $_POST['payment_type'] . "','" . $financial_year . "','" . $_SESSION['user_id'] . "')";

    $rs_cash_memo_return = mysqli_query($con, $sql_cash_memo_return);
    $last_id = mysqli_insert_id($con);
    if (!$rs_cash_memo_return) 
    {
        die('No Cash Memo Return Inserted.' . mysqli_error($con));
    }

    if(isset($_POST['quantity'][1]))
    {
        $number = count($_POST['quantity']);
    }
    else
    {
        $number = 1;
    }
    if($number > 0)
    {
        for($i=0; $i<$number; $i++)
        {
             //Insert Code For Cash Memo Return Detail 
             $sql_cash_memo_return_detail = "INSERT INTO tbl_cash_memo_return_detail(cash_memo_return_id,product_id,qty,rate,discount_per,discount_amt,gst_per,gst_amt,financial_year_id) VALUE ('".$last_id."','".$_POST['product_id'][$i]."','".$_POST['quantity'][$i]."','".$_POST['rate'][$i]."','".$_POST['discount_per'][$i]."','".$_POST['discount_amt'][$i]."','".$_POST['gst_per'][$i]."','".$_POST['gst_amt'][$i]."','".$financial_year."')";
             
             $rs__cash_memo_return_detail = mysqli_query($con,$sql_cash_memo_return_detail);
             if(!$rs__cash_memo_return_detail)
             {
                die('No Cash Memo Return Detail Inserted.'.mysqli_error($con));
             }

        }
    }
}


?>
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header-lg">
                    <h4>Cash Memo Return Invoice</h4>
                    <div class="text-end">
                        <a href="view_cash_memo_return_invoice.php" class="btn btn-light">View Invoice</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="CashMemoReturnInvoice" id="CashMemoReturnInvoice">

                        <!-- Row start -->
                        <div class="row justify-content-between">
                        <div class="col-xl-5 col-lg-5 col-md-7 col-sm-7 col-12">

                            <!-- Row start -->
                            <div class="row gutters">

                                <div class="col-12">
                                    <div class="form-section-header light-bg">Date and Invoice Number</div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="number" name="invoice_no" id="invoice_no" onchange="return getCashMemoData()" class="form-control">
                                        <div class="field-placeholder">Invoice No</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <input type="date" class="form-control " name="cash_memo_return_date" id="cash_memo_return_date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="field-placeholder">Invoice Date</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <select disabled class="select-single js-states" title="Select Term" data-live-search="true" name="state" id="state">
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

                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">

                                <!-- Row start -->
                                <div class="row gutters">

                                    <div class="col-12">
                                        <div class="form-section-header light-bg">Customer Details</div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="text" name="customer_name" id="customer_name" readonly>
                                            <div class="field-placeholder">Customer Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input class="form-control" type="number" name="mobile_no" id="mobile_no" readonly>
                                            <div class="field-placeholder">Customer Mobile No</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <textarea class="form-control" rows="2" name="narration" id="narration" readonly></textarea>
                                            <div class="field-placeholder">Narration</div>
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
                                                <th>Return Quantity</th>
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
                                                        <select class="select-single js-states w-100" data-live-search="true" id="product_id" name="product_id[]">
                                                            <option>Select Item</option>
                                                        </select>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" readonly onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control return-quantity" placeholder="Return Qty" name="return_quantity[]" id="return_quantity" onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" readonly onchange="calculateRow();">
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
                                                        <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" readonly placeholder="%" onchange="calculateRow() ;">
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
                                                    <select disabled class="form-control gst_per" name="gst_per[]" id="gst_per" placeholder="%" onchange="calculateRow() ;" >
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
                                        <tbody id="prabhat">
                                        <tr id="RRD">
                                            <td>
                                                <button class="btn btn-light" id="addNewBtn">
                                                    Add New
                                                </button>
                                            </td>
                                            <td colspan="9">
                                            </td>
                                        </tr>
                                        <tr id="ROSHAN">
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
                                                            if (!$rs_payment_type) {
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
                                        </tbody>
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
                                        <input type="hidden" name="cash_memo_return_id" id="cash_memo_return_id" />
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
    <!-- <button id="addNewDropdown">Add New</button> -->

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        var invoiceEntered = false;

        $('#invoice_no').change(function() 
        {
        if ($(this).val().trim() !== '') 
        {
            invoiceEntered = true;
        } 
            else 
        {
            invoiceEntered = false;
        }
    });

         $('#addNewBtn').click(function(event) 
        {
            event.preventDefault();

            if (!invoiceEntered) 
            {
                alert("Please enter the invoice number first.");
                return;
            }
            else
            {
                
           

            //  alert("Hello");

                // Append your HTML content to the table body with the id "dynamic_field"
                $('#dynamic_field').append(' <tr class="static-row" id="row"> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <select class="select-single js-states w-100" data-live-search="true" id="product_id" name="product_id[]"> <option>Select Item</option> </select> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" readonly onchange="calculateRow();"> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control return-quantity" placeholder="Return Qty" name="return_quantity[]" id="return_quantity" onchange="calculateRow();"> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" readonly onchange="calculateRow();"> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control gtotal" name="gtotal[]" id="gtotal" readonly onchange="calculateRow() ;"> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" readonly placeholder="%" onchange="calculateRow() ;"> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control discount_amt" name="discount_amt[]" id="discount_amt" readonly> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <select disabled class="form-control gst_per" name="gst_per[]" id="gst_per" placeholder="%" onchange="calculateRow() ;" > <option value=""selected>Select</option> <?php $sql_gst_slab = "SELECT * FROM tbl_gst_slab"; $rs_gst_slab = mysqli_query($con,$sql_gst_slab); if(!$rs_gst_slab) { die('No Record Found.'.mysqli_error($con)); } while($row_gst_slab = mysqli_fetch_array($rs_gst_slab)) { ?> <option value="<?php echo $row_gst_slab['igst']; ?>"><?php echo $row_gst_slab['igst']; ?></option> <?php } ?> </select> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <input type="number" class="form-control gst_amt" name="gst_amt[]" id="gst_amt" readonly> </div> <!-- Field wrapper end --> </td> <td> <!-- Field wrapper start --> <div class="field-wrapper m-0"> <div class="input-group"> <input type="number" class="form-control amount" placeholder="0.00" name="amount[]" id="amount" readonly> </div> </div> <!-- Field wrapper end --> </td> <td> <div class="table-actions"> <input type="hidden" name="cash_memo_detail_id" id="cash_memo_detail_id"> <button class="btn btn-light"> <i class="icon-trash-2"></i> </button> </div> </td> </tr>');

                // getCashMemoData();
                addNewDropdown();
            }
        });
     
        // Attach click event listener to dynamically added delete buttons
        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        });
       
    });
</script>
<script>
    function calculateRow() 
    {
        // alert("Hi");
        let item_quantity = document.getElementsByName("quantity[]");
        let return_quantity = document.getElementsByName("return_quantity[]");
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

        for (let i = 0; i < item_quantity.length; i++) 
        {
            qty = parseFloat(item_quantity[i].value);
            // alert(qty);
            returnQty = parseFloat(return_quantity[i].value);
            alert(returnQty);

            rate = parseFloat(item_rate[i].value);
            // alert(rate);

            // qty -= returnQty;

            gtotal = returnQty * rate;
            document.getElementsByName("gtotal[]")[i].value = gtotal.toFixed(2);

            discountPer = parseFloat(item_discPer[i].value);
            // alert(discountPer);
            discountAmt = gtotal * (discountPer / 100);
            document.getElementsByName("discount_amt[]")[i].value = discountAmt.toFixed(2);

            gstPer = parseFloat(item_gstPer[i].value);
            gstAmt = (((gtotal - discountAmt) * (gstPer)) / 100);
            document.getElementsByName("gst_amt[]")[i].value = gstAmt.toFixed(2);

            netAmount = gtotal - discountAmt + gstAmt;
            document.getElementsByName("amount[]")[i].value = netAmount.toFixed(2);

            totalAmount += netAmount;
            totalDiscountAmt += discountAmt;
        }
        $('#sub_total').val(totalAmount.toFixed(2));
        $('#discount_total').val(totalDiscountAmt.toFixed(2));
    }


    //get Cash Memo Data
    function getCashMemoData()
    {
            var invoice_no = document.getElementById("invoice_no").value;
            alert(invoice_no);

            if(invoice_no != '')
            {
                $.ajax({
                url: 'fetch_invoice_data.php',
                method: 'POST',
                data: {invoice_no: invoice_no},
                success: function(response) 
                {
                    var data = JSON.parse(response);

                    //set cash memo data
                    $('#cash_memo_id').val(data.cash_memo_info.cash_memo_id);
                    $('#customer_name').val(data.cash_memo_info.customer_name);
                    $('#mobile_no').val(data.cash_memo_info.mobile_no);
                    $('#narration').val(data.cash_memo_info.narration);
                    $('#state').val(data.cash_memo_info.place_of_supply_id).change();


                    var productDropdown = $('#product_id');
                    // alert(product_id);
                    productDropdown.empty();
                    productDropdown.append('<option value="" selected>--Select--</option>');


                    //Bind Item Combox Box Dynamically depend on invoice no
                    $.each(data.products, function(index, product) 
                    {
                         productDropdown.append('<option value="' + product.product_id + '">' + product.item_name + '</option>');
                    
                    // alert(product.product_id);
                    // alert(product_id);
                    });

                    // when product change get all Data    
                    productDropdown.change(function() 
                    {
                        var product_id = $(this).val();
                        // alert(product_id);
                        $.each(data.products, function(index, product) 
                        {
                            if (product.product_id == product_id) 
                            {
                                $('#quantity').val(product.quantity);
                                $('#rate').val(product.rate);
                                $('#gtotal').val(product.quantity * product.rate);
                                $('#discount_per').val(product.discount_per);
                                $('#discount_amt').val(product.discount_amt);
                                $('#gst_per').val(product.gst_per);
                                $('#gst_amt').val(product.gst_amt);

                                // var gtotal = parseFloat($('#gtotal').val());
                                // var discountAmt = parseFloat($('#discount_amt').val());
                                // var gstAmt = parseFloat($('#gst_amt').val());
                                // var amount = gtotal - discountAmt + gstAmt;
                                // $('#amount').val(amount.toFixed(2));
                            }
                        });
                    });
                },
                error: function(xhr, status, error) 
                {
                    console.error(error);
                }

                });
            }
    }
      
    // $('#invoice_no').on('input', function() {
    //     var invoiceNo = $(this).val();
    //     alert(invoiceNo);
    //     if (invoiceNo !== '') 
    //     {
    //         $.ajax({
    //             url: 'fetch_invoice_data.php',
    //             method: 'POST',
    //             data: {invoice_no: invoiceNo},
    //             success: function(response) 
    //             {
    //                 var data = JSON.parse(response);
                    
    //                 $('#customer_name').val(data.cash_memo_info.customer_name);
    //                 $('#mobile_no').val(data.cash_memo_info.mobile_no);
    //                 $('#narration').val(data.cash_memo_info.narration);
    //                 $('#cash_memo_return_date').val(data.cash_memo_info.cash_memo_date);
    //                 $('#state').val(data.cash_memo_info.place_of_supply_id).change();
    //                 $('#sub_total').val(data.cash_memo_info.sub_total);
    //                 $('#pay').val(data.cash_memo_info.pay);
    //                 $('#payment_type').val(data.cash_memo_info.payment_type_id).change();

    //                 var productDropdown = $('#product_id');
    //                 // alert(product_id);
    //                 productDropdown.empty();
    //                 productDropdown.append('<option value="" selected>--Select--</option>');

                    // $.each(data.products, function(index, product) 
                    // {
                    //      productDropdown.append('<option value="' + product.product_id + '">' + product.item_name + '</option>');
                    
                    // // alert(product.product_id);
                    // // alert(product_id);
                    // });
    //                     productDropdown.change(function() {
    //                     var product_id = $(this).val();
    //                     alert(product_id);
    //                     $.each(data.products, function(index, product) 
    //                     {
    //                             if (product.product_id == product_id) 
    //                             {
    //                                 $('#quantity').val(product.quantity);
    //                                 alert(product.quantity);
    //                                 $('#rate').val(product.rate);
    //                                 alert(product.rate);
    //                                 $('#gtotal').val(product.quantity * product.rate);
    //                                 $('#discount_per').val(product.discount_per);
    //                                 alert(product.discount_per);
    //                                 $('#discount_amt').val(product.discount_amt);
    //                                 $('#gst_per').val(product.gst_per);
    //                                 $('#gst_amt').val(product.gst_amt);

    //                                 var gtotal = parseFloat($('#gtotal').val());
    //                                 var discountAmt = parseFloat($('#discount_amt').val());
    //                                 var gstAmt = parseFloat($('#gst_amt').val());
    //                                 var amount = gtotal - discountAmt + gstAmt;
    //                                 $('#amount').val(amount.toFixed(2));
    //                             }
    //                         });
    //                     });
    //                 },
    //             error: function(xhr, status, error) {
    //                 console.error(error);
    //             }
    //         });
    //     }
    // });

    function addNewDropdown() 
    { 
        var cash_memo_id = document.getElementById("cash_memo_id").value;

            if(cash_memo_id != '')
            {
                $.ajax({
                url: 'fetch_invoice_detail_data.php',
                method: 'POST',
                data: {cash_memo_id: cash_memo_id},
                success: function(response) 
                {
                    var data = JSON.parse(response);
                   
                    // Get the table element
                    var table = document.getElementById('dynamic_field');

                    // Get the last row element
                    var lastRow = table.rows[table.rows.length - 1];

                    // Do something with the last row   
                    console.log(lastRow); // or any other operation you need


                    // Get the quantity cell by its ID
                    var qtyCell = lastRow.querySelector('#return_quantity');

                    // Set the text content of the quantity cell to 50
                    qtyCell.value = '50';


                    var productCell = lastRow.querySelector('#product_id');

                    // var productDropdown = productCell;
                    // alert(product_id);
                    // productDropdown.empty();
                        productCell.append('<option value="" selected >--Select--</option>');


                    //Bind Item Combox Box Dynamically depend on invoice no
                    $.each(data.products, function(index, product) 
                    {
                        // alert(product.product_id);
                        productCell.append('<option value="' + product.product_id + '">' + product.item_name + '</option>');

                        // alert(product.product_id);
                        // alert(product_id);
                    });
                    // // when product change get all Data    
                    // productDropdown.change(function() 
                    // {
                    //     var product_id = $(this).val();
                    //     // alert(product_id);
                    //     $.each(data.products, function(index, product) 
                    //     {
                    //         if (product.product_id == product_id) 
                    //         {
                    //             $('#quantity').val(product.quantity);
                    //             $('#rate').val(product.rate);
                    //             $('#gtotal').val(product.quantity * product.rate);
                    //             $('#discount_per').val(product.discount_per);
                    //             $('#discount_amt').val(product.discount_amt);
                    //             $('#gst_per').val(product.gst_per);
                    //             $('#gst_amt').val(product.gst_amt);

                    //             // var gtotal = parseFloat($('#gtotal').val());
                    //             // var discountAmt = parseFloat($('#discount_amt').val());
                    //             // var gstAmt = parseFloat($('#gst_amt').val());
                    //             // var amount = gtotal - discountAmt + gstAmt;
                    //             // $('#amount').val(amount.toFixed(2));
                    //         }
                    //     });
                    // });
                },
                error: function(xhr, status, error) 
                {
                    console.error(error);
                }

                });
            }
    }
    // $('#addNewDropdown').click(function(event) 
    // {
    //     event.preventDefault();
    //      alert("Hello");
    //      addNewDropdown(data);
         
    // });
</script>
<?php
include_once('footer.php');
?>