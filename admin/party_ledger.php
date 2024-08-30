<?php
include_once('header.php');

if (isset($_POST['BtnInvoice'])) 
{
    $financialYearQuery = "SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1";
    $financialYearResult = mysqli_query($con, $financialYearQuery);

    if (!$financialYearResult) 
    {
        die('Error: ' . mysqli_error($con));
    }
    $row_financial_year = mysqli_fetch_array($financialYearResult);
    $financial_year = $row_financial_year['financial_year_id'];

    $invoice_type = $_POST['invoice_type'];

    $invoice_type_int = ($invoice_type == 'Purchase Invoice' || $invoice_type == 'Sales Invoice') ? 0 : 1;

    $credit = 0;
    $debit = 0;

    if ($invoice_type === 'Sales Invoice' || $invoice_type === 'Purchase Return Invoice') {
        $credit = $_POST['pay'];
    } elseif ($invoice_type === 'Purchase Invoice' || $invoice_type === 'Sales Return Invoice') {
        $debit = $_POST['pay'];
    }

    // INSERT INTO PARTY LEDGER 
    $sql_party = "INSERT INTO tbl_party_ledger (party_type, party_id, related_id, related_obj_name, invoice_type, invoice_no, narration, credit, debit, party_ledger_date, financial_year_id, created_by) VALUES ('" . $_POST['party_group'] . "','" . $_POST['party_name'] . "','" . $_POST['related_id'] . "','PartyLedger','" . $invoice_type_int . "','" . $_POST['invoice_no'] . "','" . $_POST['narration'] . "','" . $credit . "','" . $debit . "','" . $_POST['invoice_date'] . "','" . $financial_year . "','" . $_SESSION['user_id'] . "')";

    $rs_party =  mysqli_query($con, $sql_party);
    $last_id = mysqli_insert_id($con);
    if (!$rs_party) {
        die('Record Not Inserted.' . mysqli_error($con));
    }
    //  INSERT INTO COMPANY LEDGER 
    $sql_company_ledger = "INSERT INTO tbl_company_ledger(related_id, related_obj, description, credit, debit, company_ledger_date, financial_year_id) VALUES ('" . $last_id . "','PartyLedger','" . $_POST['narration'] . "','" . $credit . "','" . $debit . "','" . $_POST['invoice_date'] . "','" . $financial_year . "')";
    $rs_company_ledger = mysqli_query($con, $sql_company_ledger);
    if (!$rs_company_ledger) {
        die('Record Not Inserted.' . mysqli_error($con));
    }

    echo "<script>window.location = 'party_ledger.php';</script>";
}
?>

<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header-lg">
                    <h4>Create Party Ledger</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frmPartyLedger" id="frmPartyLedger">

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
                                            <select class="select-single js-states" title="Select Term" data-live-search="true" name="party_group" id="party_group">
                                                <option value="" selected>--Select--</option>
                                                <option value="Supplier">Supplier</option>
                                                <option value="Customer">Customer</option>
                                            </select>
                                            <div class="field-placeholder">Party Group</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="field-wrapper">
                                            <select class="select-single js-states" title="Select Term" data-live-search="true" name="party_name" id="party_name">
                                                <option value="" selected>--Select--</option>
                                            </select>
                                            <div class="field-placeholder">Party Name</div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12">
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <select class="select-single js-states" title="Select Term" data-live-search="true" name="invoice_type" id="invoice_type">
                                                    <option value="" selected>--Select--</option>
                                                    <!-- <option value="Purchase Invoice">Purchase Invoice</option>
                                                    <option value="Purchase Return Invoice">Purchase Return Invoice</option>
                                                    <option value="Sales Invoice">Sales Invoice</option>
                                                    <option value="Sales Return Invoice">Sales Return Invoice</option> -->
                                                </select>
                                            </div>
                                            <div class="field-placeholder">Invoice Type</div>
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
                                                <input type="date" class="form-control " name="invoice_date" id="invoice_date" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <div class="field-placeholder">Invoice Date</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <select class="select-single js-states" title="Select Term" data-live-search="true" name="invoice_no" id="invoice_no">
                                                <option value="" selected>--Select--</option>
                                            </select>
                                            <div class="field-placeholder">Invoice No</div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <textarea class="form-control" rows="3" name="narration" id="narration"></textarea>
                                            <div class="field-placeholder">Notes</div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12">
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input class="form-control" readonly type="number" name="amount" id="amount">
                                            </div>
                                            <div class="field-placeholder">Amount</div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12">
                                        <div class="field-wrapper">
                                            <div class="input-group">
                                                <input class="form-control" type="decimal" name="pay" id="pay" oninput="validatePay()">
                                            </div>
                                            <div class="field-placeholder">Pay</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Row end -->

                            </div>

                        </div>
                        <!-- Row end -->


                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-actions-footer">
                                    <div class="text-end">
                                        <input type="hidden" name="related_id" id="related_id">
                                        <button type="submit" name="BtnInvoice" id="BtnInvoice" class="btn btn-primary ms-1">Create Invoice</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Row end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize dropdowns
        $('#party_name').prop('disabled', true);
        $('#invoice_type').prop('disabled', true);
        $('#invoice_no').prop('disabled', true);

        // $('#BtnInvoice').prop('disabled', true);

        $('#party_group').change(function() {
            var party_group = $(this).val();

            // Disable the other dropdowns
            $('#party_name').prop('disabled', true);
            $('#invoice_type').prop('disabled', true);
            $('#invoice_no').prop('disabled', true);

            $.ajax({
                url: 'fetch_party_names.php',
                type: 'post',
                data: {
                    party_group: party_group
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.length;
                    $("#party_name").empty();

                    $("#party_name").append("<option value='' selected>--Select--</option>");

                    for (var i = 0; i < len; i++) {
                        var party = response[i];
                        $("#party_name").append("<option value='" + party.party_id + "'>" + party.party_name + "</option>");
                    }

                    // Enable party_name dropdown
                    $('#party_name').prop('disabled', false);
                    $('#invoice_type').empty();
                    // Add the default "Select" option
                    $('#invoice_type').append("<option value='' selected>--Select--</option>");

                    if (party_group === 'Supplier') {
                        $('#invoice_type').append(
                            $('<option>', {
                                value: 'Purchase Invoice',
                                text: 'Purchase Invoice'
                            }),
                            $('<option>', {
                                value: 'Purchase Return Invoice',
                                text: 'Purchase Return Invoice'
                            })
                        );
                    } else if (party_group === 'Customer') {
                        $('#invoice_type').append(
                            $('<option>', {
                                value: 'Sales Invoice',
                                text: 'Sales Invoice'
                            }),
                            $('<option>', {
                                value: 'Sales Return Invoice',
                                text: 'Sales Return Invoice'
                            })
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#party_name').change(function() {
            var party_id = $(this).val();

            // Disable the invoice_type dropdown
            $('#invoice_type').prop('disabled', true);

            // Enable invoice_type dropdown
            $('#invoice_type').prop('disabled', false);
        });

        $('#invoice_type').change(function() {
            var invoice_type = $(this).val();
            var party_id = $('#party_name').val();
            var party_group = $('#party_group').val();

            // Disable the invoice_no dropdown
            $('#invoice_no').prop('disabled', true);

            $.ajax({
                url: 'fetch_invoice_numbers.php',
                type: 'POST',
                data: {
                    invoice_type: invoice_type,
                    party_id: party_id,
                    party_group: party_group
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // Populate the invoice numbers dropdown
                    updateInvoiceNumbers(response);

                    // Enable invoice_no dropdown
                    $('#invoice_no').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Function to update the invoice numbers dropdown
        function updateInvoiceNumbers(invoiceData) {
            $('#invoice_no').empty(); // Clear existing options

            // Append the default "Select" option
            $('#invoice_no').append($('<option>', {
                value: '',
                text: '--Select--'
            }));

            if (invoiceData.length > 0) {
                $.each(invoiceData, function(index, invoice) {
                    $('#invoice_no').append($('<option>', {
                        value: invoice.invoice_no,
                        text: invoice.invoice_no,
                        'data-invoice-id': invoice.invoice_id
                    }));
                });
            }
        }

        $('#invoice_no').change(function() {
            var invoice_no = $(this).val();
            var invoice_id = $(this).find(':selected').data('invoice-id');

            // Set the invoice ID to the related_id input field
            $('#related_id').val(invoice_id);

            $.ajax({
                url: 'fetch_invoice_amount.php',
                type: 'post',
                data: {
                    invoice_no: invoice_no,
                    invoice_id: invoice_id,
                    party_group: $('#party_group').val(),
                    party_id: $('#party_name').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#amount').val(response.amount);
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


<?php
include_once('footer.php');
?>