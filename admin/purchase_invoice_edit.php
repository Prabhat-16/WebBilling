<?php
    include_once('header.php');

if (!isset($_GET['id'])) 
{
    echo "<script>window.location = 'view_purchase_invoice.php';</script>";
} else {

    $sql_view = "SELECT * FROM tbl_purchase_invoice WHERE purchase_invoice_id = '".$_GET['id']."'";
    $rs_view = mysqli_query($con,$sql_view);
    if(!$rs_view)
    {
        die('No Record Found.'.mysqli_error($con));
    }
    $row_view = mysqli_fetch_array($rs_view);

    $sql_detail_view = "SELECT * FROM tbl_purchase_invoice_detail WHERE purchase_invoice_id = '".$_GET['id']."'";
    $rs_detail_view = mysqli_query($con,$sql_detail_view);
    if(!$rs_detail_view)
    {
        die('No Detail Record Found.'.mysqli_error($con));
    }

    $invoiceNumberQuery = "Select invoice_no FROM tbl_purchase_invoice WHERE purchase_invoice_id  = '".$_GET['id']."'";
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

    if (!$financialYearResult) {
        die('Error: ' . mysqli_error($con));
    }
    $row_financial_year = mysqli_fetch_array($financialYearResult);
    $financial_year = $row_financial_year['financial_year_id'];

    
    $description = 'Purchase:Invoice_no:'.$invoice_no;

    if(isset($_POST['BtnInvoice']))
    {
        echo "Clicked";

        //Update Code For Purchase Invoice
        $sql_purchase_invoice_update = "UPDATE tbl_purchase_invoice SET party_id = '".$_POST['party_name']."'  ,due_days = '".$_POST['credit_period']."' , purchase_date = '".$_POST['invoice_date']."' , due_date = '".$_POST['due_date']."' , narration  = '".$_POST['narration']."', net_total = '".$_POST['sub_total']."' , discount = '".$_POST['discount_total']."' , pay = '".$_POST['pay']."' , place_of_supply_id = '".$_POST['state']."' , payment_type_id = '".$_POST['payment_type']."' , financial_year_id = '".$financial_year."' , created_by = '".$_SESSION['user_id']."' WHERE purchase_invoice_id  = '".$_GET['id']."'";
        $rs_purchase_invoice_update = mysqli_query($con,$sql_purchase_invoice_update);
        if(!$rs_purchase_invoice_update)
        {
            die('Purchase Invoice Not Updated.'.mysqli_error($con));
        }
        if (isset($_POST['quantity'][1])) {
            $number = count($_POST['quantity']);
        } else {
            $number = 1;
        }
        if ($number > 0) {
            if (isset($_POST['purchase_invoice_detail_id'])) 
            {
                echo implode(",", $_POST['purchase_invoice_detail_id']);
            }

            for ($i = 0; $i < $number; $i++) 
            {

                echo   $_POST['purchase_invoice_detail_id'][$i];
                if ($_POST['purchase_invoice_detail_id'][$i] ==  0) {
                    $sql_purchase_invoice_detail_update = "INSERT INTO tbl_purchase_invoice_detail(purchase_invoice_id,product_id,qty,rate,discount_per,discount_amt,gst_per,gst_amt,financial_year_id) VALUE ('" . $_GET['id'] . "','" . $_POST['product_id'][$i] . "','" . $_POST['quantity'][$i] . "','" . $_POST['rate'][$i] . "','" . $_POST['discount_per'][$i] . "','" . $_POST['discount_amt'][$i] . "','" . $_POST['gst_per'][$i] . "','" . $_POST['gst_amt'][$i] . "','" . $financial_year . "')";
                } else 
                {
                    // Update Code For Cash Memo Detail
                    $sql_purchase_invoice_detail_update = "UPDATE tbl_purchase_invoice_detail SET  product_id = '" . $_POST['product_id'][$i] . "' , qty = '" . $_POST['quantity'][$i] . "' , rate = '" . $_POST['rate'][$i] . "' , discount_per = '" . $_POST['discount_per'][$i] . "' , discount_amt = '" . $_POST['discount_amt'][$i] . "' , gst_per = '" . $_POST['gst_per'][$i] . "' , gst_amt = '" . $_POST['gst_amt'][$i] . "' , financial_year_id = '" . $financial_year . "' WHERE purchase_invoice_detail_id  = '" . $_POST['purchase_invoice_detail_id'][$i] . "' ";
                    // echo $sql_purchase_invoice_detail_update ;
                }

                $rs_cash_memo_detail_update = mysqli_query($con, $sql_purchase_invoice_detail_update);
                if (!$rs_cash_memo_detail_update) 
                {
                    die('Cash Memo Detail Not Updated');
                }
            }

            //Update Code For Company Ledger
            $sql_purchase_invoice_ledger_update = "UPDATE tbl_company_ledger SET  description = '".$description."' , credit = 0.00 , debit = '".$_POST['pay']."' , company_ledger_date = '".$_POST['invoice_date']."' , financial_year_id = '".$financial_year."' WHERE related_id = '".$_POST['purchase_invoice_id']."' AND related_obj = 'PO'";
            $rs_purchase_invoice_ledger_update = mysqli_query($con,$sql_purchase_invoice_ledger_update);
            if(!$rs_purchase_invoice_ledger_update)
            {
                die('Company Ledger Not Updated.'.mysqli_error($con));
            }

            //Update Code For Party Ledger
            $sql_party_ledger = "UPDATE tbl_party_ledger SET party_type = 'Supplier' , party_id = '".$_POST['party_name']."' , invoice_type = '0' ,  narration = '".$description."' , credit = '0' ,debit = '".$_POST['pay']."' , party_ledger_date = '".$_POST['invoice_date']."' , financial_year_id = '".$financial_year."' , created_by = '".$_SESSION['user_id']."' WHERE related_id = '".$_POST['purchase_invoice_id']."'AND related_obj_name = 'PO' ";
            $rs_party_ledger = mysqli_query($con,$sql_party_ledger);
            if(!$rs_party_ledger)
            {
                die('Party Ledger Not Updated.'.mysqli_error($con));
            }
        }
        echo "<script>window.location = 'view_purchase_invoice.php';</script>";
    }
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
                    <h4>Update Purchase Invoice</h4>
                    <div class="text-end">
                        <a href="view_purchase_invoice.php" class="btn btn-light">View Invoice</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frmPurchaseInvoice" id="frmPurchaseInvoice">

                        <!-- Row start -->
                        <div class="row justify-content-between">

                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">

                                <!-- Row start -->
                                <div class="row gutters">

                                    <div class="col-12">
                                        <div class="form-section-header light-bg">Customer Details</div>
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <select class="select-single js-states" title="Select Term" data-live-search="true" name="party_name" id="party_name">
                                                <option value="" selected>--Select--</option>
                                                <?php
                                                $sql_party_type = "SELECT * FROM tbl_party WHERE party_type = 'Supplier'";
                                                $rs_party_type = mysqli_query($con, $sql_party_type);
                                                if (!$rs_party_type) {
                                                    die('No Party Found.' . mysqli_error($con));
                                                }
                                                while ($row_party_type = mysqli_fetch_array($rs_party_type)) 
                                                {
                                                    if($row_view['party_id'] == $row_party_type['party_id'])
                                                {?>
                                                    <option value="<?php echo $row_party_type['party_id']; ?>"selected="selected"><?php echo $row_party_type['party_name']; ?></option>
                                                <?php
                                                }
                                                else
                                                {?>
                                                  <option value="<?php echo $row_party_type['party_id']; ?>"><?php echo $row_party_type['party_name']; ?></option>
                                                  <?php
                                                }
                                            }
                                            ?>
                                            </select>
                                            <div class="field-placeholder">Customer Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <textarea class="form-control" rows="3" name="narration" id="narration" ><?php echo $row_view['narration']; ?></textarea>
                                            <div class="field-placeholder">Notes</div>
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
                                                <input type="date" class="form-control " name="invoice_date" id="invoice_date" value="<?php echo $row_view['purchase_date']; ?>">
                                                <!-- <span class="input-group-text">
                                            <i class="icon-calendar1"></i>
                                        </span> -->
                                            </div>
                                            <div class="field-placeholder">Invoice Date</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="number" name="invoice_no" id="invoice_no" class="form-control" value="<?php echo $row_view['invoice_no']; ?>" readonly>
                                            <div class="field-placeholder">Invoice No</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="credit_period" id="credit_period" value="<?php echo $row_view['due_days']; ?>" readonly>
                                                <span class="input-group-text">
                                                    Days
                                                </span>
                                            </div>
                                            <div class="field-placeholder">Credit Period</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input class="form-control" type="date" name="due_date" id="due_date" value="<?php echo $row_view['due_date']; ?>" readonly>

                                            </div>
                                            <div class="field-placeholder">Due Date</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="ref_order_no" id="ref_order_no" value="<?php echo $row_view['ref_order_no']; ?>">

                                            </div>
                                            <div class="field-placeholder">Order Ref No</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
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
                                                        if ($row_view['place_of_supply_id'] == $row_state['state_id']) { ?>
                                                            <option value="<?php echo $row_state['state_id'] ?>" selected><?php echo $row_state['state_name']; ?></option>
                                                        <?php
                                                        } else { ?>
                                                            <option value="<?php echo $row_state['state_id'] ?>"><?php echo $row_state['state_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
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
                                            <?php
                                                while($row_detail_view = mysqli_fetch_array($rs_detail_view))
                                                {
                                                    $gtotal = $row_detail_view['qty'] * $row_detail_view['rate'];
                                                    $amount = $gtotal - $row_detail_view['discount_amt'] + $row_detail_view['gst_amt'];
                                                ?>
                                            <tr class="static-row" id="row0">
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                    <input type="hidden" name="purchase_invoice_detail_id[]" id="purchase_invoice_detail_id" value="<?php echo $row_detail_view['purchase_invoice_detail_id']; ?>">
                                                        <select class="select-single js-states w-100" data-live-search="true" id="product_id" name="product_id[]" >
                                                            <option>Select Item</option>
                                                            <?php
                                                                $sql_item = "SELECT * FROM tbl_item";
                                                                $rs_item = mysqli_query($con, $sql_item);
                                                                if (!$rs_item) {
                                                                    die('No Item Found.' . mysqli_error($con));
                                                                }
                                                                while ($row_item = mysqli_fetch_array($rs_item)) {
                                                                    if ($row_detail_view['product_id'] == $row_item['item_id']) { ?>
                                                                        <option value="<?php echo $row_item['item_id']; ?>" selected><?php echo $row_item['item_name']; ?></option>
                                                                    <?php
                                                                    } else { ?>
                                                                        <option value="<?php echo $row_item['item_id']; ?>"><?php echo $row_item['item_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                                                        <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" value="<?php echo $row_detail_view['qty'] ?>" onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" value="<?php echo $row_detail_view['rate']; ?>" onchange="calculateRow();">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control gtotal" name="gtotal[]" id="gtotal" value="<?php echo $gtotal; ?>" readonly onchange="calculateRow() ;">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" value="<?php echo $row_detail_view['discount_per']; ?>" placeholder="%" onchange="calculateRow() ;">
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control discount_amt" name="discount_amt[]" id="discount_amt" value="<?php echo $row_detail_view['discount_amt']; ?>" readonly>
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
                                                                    if($row_detail_view['gst_per'] == $row_gst_slab['igst'])
                                                            {?>
                                                            <option value="<?php echo $row_gst_slab['igst']; ?>"selected="selected"><?php echo $row_gst_slab['igst']; ?></option>
                                                            <?php
                                                                }
                                                                else
                                                            {?>
                                                              <option value="<?php echo $row_gst_slab['igst']; ?>"><?php echo $row_gst_slab['igst']; ?></option>
                                                              <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <input type="number" class="form-control gst_amt" name="gst_amt[]" id="gst_amt" value="<?php echo $row_detail_view['gst_amt']; ?>" readonly>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <!-- Field wrapper start -->
                                                    <div class="field-wrapper m-0">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control amount" placeholder="0.00" name="amount[]" id="amount" value="<?php echo $amount; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Field wrapper end -->
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="#" class="btn btn-light btn-delete" id="<?php echo $row_detail_view['purchase_invoice_detail_id']; ?>" name="BtnDelete">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tr>
                                                <td>
                                                    <button class="btn btn-light" id="addNewBtn">
                                                        Add New
                                                    </button>
                                                </td>
                                                <td colspan="9">
                                                    <div class="row gutters justify-content-end">
                                                        <div class="col-auto">
                                                            <label class="col-form-label">Discount of Total Amount</label>
                                                        </div>
                                                        <div class="col-auto" style="max-width: 90px;">
                                                            <input type="text" id="discount_total" name="discount_total" value="<?php echo $row_view['discount']; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">&nbsp;</td>
                                                <td colspan="2">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <!-- Field wrapper start -->
                                                        <div class="field-wrapper">
                                                            <div class="input-group">
                                                                <input class="form-control" readonly type="number" name="sub_total" id="sub_total" value="<?php echo $row_view['net_total']; ?>" placeholder="0.00">
                                                            </div>
                                                            <div class="field-placeholder">Sub Total</div>
                                                        </div>
                                                        <!-- Field wrapper end -->
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <!-- Field wrapper start -->
                                                        <div class="field-wrapper">
                                                            <div class="input-group">
                                                                <input class="form-control" type="text" name="pay" id="pay" value="<?php echo $row_view['pay']; ?>" placeholder="0.00">
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
                                                            while ($row_payment_type = mysqli_fetch_array($rs_payment_type)) {
                                                                if ($row_view['payment_type_id'] == $row_payment_type['payment_type_id']) { ?>
                                                                    <option value="<?php echo $row_payment_type['payment_type_id']; ?>" selected><?php echo $row_payment_type['payment_type']; ?></option>
                                                                <?php
                                                                } else { ?>
                                                                    <option value="<?php echo $row_payment_type['payment_type_id']; ?>"><?php echo $row_payment_type['payment_type']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            }
                                                            ?>
                                                            </select>
                                                            <div class="field-placeholder">Payment Type</div>
                                                        </div>
                                                        <!-- Field wrapper end -->
                                                    </div>
                                                </td>
                                                <!-- <td>
                                                    <p class="m-0">$0.00</p>
                                                    <p class="m-0">$0.00</p>
                                                    <p class="m-0">$0.00</p>
                                                    <h5 class="mt-2">$0.00</h5>
                                                </td> -->
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
                                        <input type="hidden" name="purchase_invoice_id" id="purchase_invoice_id" value="<?php echo $row_view['purchase_invoice_id'] ?>" />
                                        <!-- <button class="btn btn-light">Save as Draft</button> -->
                                        <button type="submit" name="BtnInvoice" id="BtnInvoice" class="btn btn-primary ms-1">Update Invoice</button>
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
<!-- Content wrapper end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Define a function to handle the "Add New" button click
        $('#addNewBtn').click(function(event) 
        {
            event.preventDefault();

            // alert("Hello");

            // Append your HTML content to the table body with the id "dynamic_field"
            $('#dynamic_field').append('<tr class="static-row" id="row"> <td>  <div class="field-wrapper m-0">  <input type="hidden" name="purchase_invoice_detail_id[]" id="purchase_invoice_detail_id" value="0"> <select class="select-single js-states w-100 item_name" data-live-search="true" name="product_id[]" id="product_id"> <option value="" selected>--Select--</option> <?php $sql_item = "SELECT * FROM tbl_item"; $rs_item = mysqli_query($con, $sql_item); if (!$rs_item) { die('No Item Found.' . mysqli_error($con)); } while ($row_item = mysqli_fetch_array($rs_item)) { ?> <option value="<?php echo $row_item['item_id']; ?>"><?php echo $row_item['item_name']; ?></option> <?php } ?> </select> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="number" class="form-control quantity" placeholder="Qty" name="quantity[]" id="quantity" onchange="calculateRow();"> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="number" class="form-control rate" name="rate[]" id="rate" placeholder="Rate" onchange="calculateRow();"> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="number" class="form-control gtotal" name="gtotal[]" id="gtotal" onchange="calculateRow() ;" readonly> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="decimal" class="form-control discount_per" name="discount_per[]" id="discount_per" placeholder="%" onchange="calculateRow()"> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="number" class="form-control discount_amt" name="discount_amt[]" id="discount_amt" readonly> </div>  </td> <td>  <div class="field-wrapper m-0"> <select class="form-control gst_per" name="gst_per[]" id="gst_per" placeholder="%" onchange="calculateRow() ;"> <option value=""selected>Select</option> <?php $sql_gst_slab = "SELECT * FROM tbl_gst_slab"; $rs_gst_slab = mysqli_query($con,$sql_gst_slab); if(!$rs_gst_slab) { die('No Record Found.'.mysqli_error($con)); } while($row_gst_slab = mysqli_fetch_array($rs_gst_slab)) { ?> <option value="<?php echo $row_gst_slab['igst']; ?>"><?php echo $row_gst_slab['igst']; ?></option> <?php } ?> </select> </div>  </td> <td>  <div class="field-wrapper m-0"> <input type="number" class="form-control gst_amt" name="gst_amt[]" id="gst_amt" readonly> </div>  </td> <td>  <div class="field-wrapper m-0"> <div class="input-group"> <input type="number" class="form-control amount" placeholder="0.00" name="amount[]" id="amount" readonly> </div> </div>  </td> <td> <div class="table-actions"><a href="#" class="btn btn-light btn-delete" id="BtnDelete" name="BtnDelete"> <i class="icon-trash-2"></i> </a> </div> </td> </tr>');
        });

        //Code For Fetch rate
        $(document).on('change', '#product_id', function() 
        {
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
       //Delete Code For Detail 
       $(document).on('click', '.btn-delete', function(event) {
        event.preventDefault();
        var purchase_invoice_detail_id  = $(this).attr("id");
       
            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'purchase_invoice_detail_delete.php',
                    data: {
                        'id': purchase_invoice_detail_id ,
                        'delete': 1
                    },
                    type: 'post',
                    success: function(output) {
                        window.location.reload();
                    }
                });
            }
    });

        $('#party_name').change(function() 
        {

            var party_id = $(this).val();
            var invoice_date = $('#invoice_date').val();

            // Check if the invoice date is not empty
            if (invoice_date === "") 
            {
                alert('Please select an invoice date.');
                return;
            }

            $.ajax({
                url: 'fetch_credit_period.php',
                type: 'post',
                data: {
                    party_id: party_id
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response && response.status === 'success') 
                    {
                        var credit_period = response.credit_period;
                        console.log("Credit Period: ", credit_period);
                        console.log("Invoice Date: ", invoice_date);
                        if (credit_period !== null && !isNaN(credit_period) && credit_period > 0) {
                            // Check if credit period is valid
                            $('#credit_period').val(credit_period); // Set the value of the credit period text box

                            // Calculate due date
                            var invoiceDate = new Date(invoice_date);
                            var due_date = new Date(invoiceDate.getTime() + credit_period * 24 * 60 * 60 * 1000); // Add credit period in milliseconds
                            var due_date_formatted = due_date.toISOString().split('T')[0];
                            console.log("Due Date: ", due_date_formatted);
                            $('#due_date').val(due_date_formatted); // Set the value of the due date text box
                        } else {
                            alert('Invalid credit period.');
                        }
                    } 
                    else 
                    {
                        alert('Error fetching credit period.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Error fetching credit period.');
                }
            });
        });

        // Calculate due date when invoice date changes
        $('#invoice_date').change(function() 
        {
            var invoice_date = $(this).val();
            var credit_period = $('#credit_period').val();

            // Check if the invoice date and credit period are not empty
            if (invoice_date === "" || credit_period === "") 
            {
                alert('Please select an invoice date and make sure credit period is calculated.');
                return;
            }

            // Calculate due date
            var invoiceDate = new Date(invoice_date);
            var due_date = new Date(invoiceDate.getTime() + credit_period * 24 * 60 * 60 * 1000);
            var due_date_formatted = due_date.toISOString().split('T')[0];
            console.log("Due Date: ", due_date_formatted);
            $('#due_date').val(due_date_formatted);
        });
      

    });
</script>

<script>
    // Function to calculate subtotal for a row
    function calculateRow() 
    {
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
            qty = parseFloat(item_quantity[i].value);
            // alert(qty);

            rate = parseFloat(item_rate[i].value);
            // alert(rate);

            gtotal = qty * rate;
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
      

</script>

<?php
    include_once('footer.php');
?>