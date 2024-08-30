<?php
    include_once('header.php');

    $uploadDir = '../images/income/';

$allowTypes = array('jpg', 'png', 'jpeg');

if (isset($_POST['btn_income'])) 
{
        try
        {
    // echo "Btn Clicked";

    $uploadedFile = '';
    // Check if a file is uploaded
    if (!empty($_FILES["income_photo"]["name"])) 
    {
        $fileName = basename($_FILES["income_photo"]["name"]);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if the file type is allowed
        if (in_array($fileType, $allowTypes)) 
        {
            // Upload file to the server
            if (move_uploaded_file($_FILES["income_photo"]["tmp_name"], $targetFilePath)) 
            {
                $uploadedFile = $fileName;
            } 
            else 
            
            {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, there was an error uploading your file.';
            }
        } 
        else {
            $uploadStatus = 0;
            $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
        }
    }

    // Fetch the maximum invoice number from the database
    $invoiceNumberQuery = "Select IFNull(Max(income_invoice_no),0)+1 as income_invoice_no From tbl_income WHERE financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1)";
    $invoiceNumberResult = mysqli_query($con, $invoiceNumberQuery);

    if (!$invoiceNumberResult) 
    {
        die('Error: ' . mysqli_error($con));
    }

    $row_invoice = mysqli_fetch_array($invoiceNumberResult);
    $income_invoice_no = $row_invoice['income_invoice_no'];

    //Fetching Financial Code
    $financialYearQuery = "SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1";
    $financialYearResult = mysqli_query($con, $financialYearQuery);

    if (!$financialYearResult) 
    {
        die('Error: ' . mysqli_error($con));
    }

    $row_financial_year = mysqli_fetch_array($financialYearResult);
    $financial_year = $row_financial_year['financial_year_id'];
    $income_description = 'Income '.$_POST['income_description'];
    


    if ($_POST['income_id'] == "") 
    {
        
        $sql_income = "INSERT INTO tbl_income (income_type_id, income_invoice_no, income_invoice_date, income_amount, income_description, income_photo, payment_type_id, financial_year_id) VALUES ('" . $_POST['income_type'] . "','" . $income_invoice_no . "','" . $_POST['income_invoice_date'] . "','" . $_POST['income_amount'] . "','" . $_POST['income_description'] . "','" . $uploadedFile . "','" . $_POST['payment_type'] . "','" . $financial_year . "')";
        $rs_income = mysqli_query($con, $sql_income);
        $last_id = mysqli_insert_id($con);
        echo $last_id; 
        if (!$rs_income) 
        {
            die('No Income Inserted.' . mysqli_error($con));
        }

         // Insert into tbl_company_ledger
         $sql_company_expense_ledger = "INSERT INTO tbl_company_ledger (related_id , related_obj , description , credit , debit , company_ledger_date , financial_year_id) VALUES ('".$last_id."','Income','".$income_description."','".$_POST['income_amount']."','0.00','".$_POST['income_invoice_date']."','".$financial_year."')";
        //  echo "$sql_company_expense_ledger";
 
         $rs_company_ledger = mysqli_query($con, $sql_company_expense_ledger);
         if (!$rs_company_ledger) 
         {
             die('Error: ' . mysqli_error($con));
         }
    } 
        else 
    { 
       
        $sql_income = "UPDATE tbl_income SET income_type_id = '" . $_POST['income_type'] . "', income_invoice_date =  '" . $_POST['income_invoice_date'] . "', income_amount = '" . $_POST['income_amount'] . "', income_description = '" . $_POST['income_description'] . "', income_photo =  '" . $uploadedFile . "',payment_type_id = '" . $_POST['payment_type'] . "', financial_year_id = '" . $financial_year . "'
        WHERE income_id  = '" . $_POST['income_id'] . "' ";
        // echo $sql_income;
        $rs_income = mysqli_query($con, $sql_income);
        if (!$rs_income) 
        {
            die('No Income Updated.' . mysqli_error($con));
        }
    

        $sql_company_income_ledger = "UPDATE tbl_company_ledger SET description = '".$income_description."' ,company_ledger_date = '".$_POST['income_invoice_date']."' , credit = '".$_POST['income_amount']."' WHERE related_id = '".$_POST['income_id']."' AND related_obj = 'Income'";
        $rs_company_ledger = mysqli_query($con, $sql_company_income_ledger);
        if (!$rs_company_ledger) 
        {
            die('Error: ' . mysqli_error($con));
        }
    }
   
    echo "<script>window.location = 'income.php';</script>";
}catch (Exception $e) {
    if ($e->getCode() == 1062) { // Duplicate entry error code
        echo "<script language='javascript' type='text/javascript'>";
        echo "alert('Income  Already Exists')";
        echo "</script>";
        // echo "<script>window.location = 'income.php';</script>";
    }
    return $e;
}
}
?>

<div class="content-wrapper">

<!-- Row start -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <!-- Card start -->
        <div class="card">
            <div class="card-header">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Income Master</div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" name="frm_income" id="frm_income" enctype="multipart/form-data">

                    <!-- Row start -->
                    <div class="row gutters">

                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="row gutters">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <select name="income_type" id="income_type" onchange="if(this.value=='income_type.php') getIncomeType()">
                                            <option value="" selected>--Select--</option>
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
                                            <option value="income_type.php">--Add New Income Type--</option>
                                        </select>
                                        <div class="field-placeholder">Income Type </div>

                                    </div>
                                    <!-- Field wrapper end -->

                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <input type="date" class="form-control " id="income_invoice_date" name="income_invoice_date" value="<?php echo date('Y-m-d'); ?>">
                                            <!-- <span class="input-group-text">
                                                <i class="icon-calendar1"></i>
                                            </span> -->
                                        </div>
                                        <div class="field-placeholder">Invoice Date</div>
                                    </div>

                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                    <div class="field-wrapper">
                                        <div class="input-group">
                                            <?php
                                            // Fetch the maximum invoice number from the database
                                            $invoiceNumberQuery = "Select IFNull(Max(income_invoice_no),0)+1 as income_invoice_no From tbl_income WHERE financial_year_id = (SELECT financial_year_id FROM tbl_financial_year WHERE is_default = 1)";
                                            $invoiceNumberResult = mysqli_query($con, $invoiceNumberQuery);

                                            if (!$invoiceNumberResult) 
                                            {
                                                die('Error: ' . mysqli_error($con));
                                            }

                                            $row_invoice = mysqli_fetch_array($invoiceNumberResult);
                                            $income_invoice_no = $row_invoice['income_invoice_no'];
                                            ?>
                                            <input class="form-control" readonly type="number" name="income_invoice_no" id="income_invoice_no"  value="<?php echo $row_invoice['income_invoice_no']; ?>">
                                         
                                        </div>
                                        <div class="field-placeholder">Invoice No</div>
                                    </div>
                                </div>


                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="number" class="form-control" name="income_amount" id="income_amount" placeholder="0.00" required>
                                        <div class="field-placeholder">Amount<span class="text-danger">*</span></div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-12" id="passDiv">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <select name="payment_type" id="payment_type" onchange="if(this.value=='payment_type.php') getPaymentType()">
                                            <option value="" selected>--Select--</option>
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
                                            <option value="payment_type.php">--Add New Payment Type--</option>
                                        </select>
                                        <div class="field-placeholder">Payment Type <span class="text-danger">*</span></div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="text" class="form-control" name="income_description" id="income_description" required>
                                        <div class="field-placeholder">Description<span class="text-danger">*</span></div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                            <div class="vertical"></div>
                            <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                    <input type="file" id="upload-income-default" name="income_photo" style="display:none;" onchange="saveImage(this)" />
                                    <input type="hidden" id="upload-income-photo-temp-default" value="" />
                                    <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-income-default-preview" for="upload-income-default">Upload Income Proof</label></div>

                                </div>

                                <div style="text-align:center;padding-top:10px;">
                                    <button class="btn btn-outline-primary" onclick="clearIncomePhotoDefault()">ClearImage</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="income_id" id="income_id">
                            <input type="hidden" name="upload_income_photo" id="upload_income_photo">
                            <button type="submit" name="btn_income" id="btn_income" class="btn btn-primary" onclick="return validate()">Save Income</button>
                            <button type="reset" class="btn btn-light" name="btn_reset" id="btn_reset">Cancel</button>
                        </div>
                    </div>
                    <!-- Row end -->
                </form>
            </div>
        </div>
        <!-- Card end -->

    </div>
</div>

<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <div class="card-body">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Income Data </div>
                </div>

                <div class="table-responsive">
                    <table id="copy-print-csv" class="table v-middle">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Income Type</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Payment Type</th>
                                <th>Added Date</th>
                                <th>Proof</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql_view = "CALL viewIncome()";
                            $rs_view = mysqli_query($con, $sql_view);
                            if (!$rs_view) {
                                die('View Not Found.' . mysqli_error($con));
                            }
                            while ($row_view = mysqli_fetch_array($rs_view)) {
                            ?>
                                <tr>

                                    <td>
                                        <div class="actions">
                                            <a href="#" id="<?php echo $row_view['income_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="icon-edit1 text-info"></i>
                                            </a>
                                            <a href="#" id="<?php echo $row_view['income_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="icon-x-circle text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $row_view['income_type']; ?></td>
                                    <td><?php echo $row_view['income_invoice_no'] ?></td>
                                    <td><?php echo $row_view['income_invoice_date'] ?></td>
                                    <td><?php echo $row_view['income_amount'] ?></td>
                                    <td><?php echo $row_view['income_description'] ?></td>
                                    <td><?php echo $row_view['payment_type'] ?></td>
                                    <!-- <td><?php echo $row_view['expence_invoice_no'] ?></td> -->
                                    <td><?php echo date("d-m-Y", strtotime($row_view['added_date'])); ?></td>
                                    <td><img src="../images/income/<?php if ($row_view['income_photo'] == "") {
                                                                        echo 'noproof.jpg';
                                                                    } else {
                                                                        echo $row_view['income_photo'];
                                                                    } ?>" width="40px" height="40px"></td>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var income_id = $(this).attr("id");

            //   alert(income_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'income_delete.php',
                    data: {
                        'id': income_id,
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
            var income_id = $(this).attr("id");

            //    alert(income_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'income_fetch.php',
                    data: {
                        'id': income_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.income_id);
                        document.getElementById("income_id").value = income_id;
                        document.getElementById("income_type").value = data.income_type_id;
                        document.getElementById("income_invoice_no").value = data.income_invoice_no;
                        document.getElementById("income_invoice_date").value = data.income_invoice_date;
                        document.getElementById("income_amount").value = data.income_amount;
                        document.getElementById("income_description").value = data.income_description;
                        document.getElementById("payment_type").value = data.payment_type_id;
                        document.getElementById("upload-income-photo-temp-default").value = data.income_photo;
                        document.getElementById("upload_income_photo").value = data.income_photo;

                        $("#upload-income-photo-temp-default").val(data.income_photo);
                        var imgStr = "<img src='" + '../images/income/' + data.income_photo + "' style='height:200px;width:200px;margin-top:-54px;'>";
                        $("#upload-income-default-preview").html(imgStr);
                        $("#upload-income-default-preview").css('color', 'initial');
                    },
                    error: function(data) {
                        console.log('my ERROR' + data.d);
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>
<script>
    function saveImage(input) {
        var previewStr = "#" + input.id + "-preview";
        if (input.files && input.files[0]) {
            var fildr = new FileReader();
            fildr.onload = function(e) {
                var imgStr = "<img src='" + e.target.result + "' style='height:200px;width:200px;margin-top:-54px;'>";
                $(previewStr).html(imgStr);
                $(previewStr).css('color', 'initial');
            }
            fildr.readAsDataURL(input.files[0]);
            return true;
        } else {
            var message = "";
            if (input.id == "upload-image" || input.id == "upload-image-default") {
                message = "Income Photo Is Needed.";
            } else {
                message = "Income Photo Is Needed.";
            }
            $(previewStr).html(message);
            $(previewStr).css('color', 'red');
            return false;
        }
    }

    function clearIncomePhotoDefault() {
        $("#upload-income-default-preview").html("Upload Income Photo.");
        $("#upload-income-default").val("");
    }

    function getIncomeType() 
    {
        window.location.href = 'income_type.php';
    }

    function getPaymentType() 
    {
        window.location.href = 'payment_type.php';
    }

    function validate()
    {
        var income_type = document.getElementById("income_type").value;

        var income_invoice_date = document.getElementById("income_invoice_date").value;

        var income_amount = document.getElementById("income_amount").value;

        var payment_type = document.getElementById("payment_type").value;

        var income_description = document.getElementById("income_description").value;


        if(income_type == "")
        {
            alert("Please Select Income Type.");
            return false;
        }        

        if(income_invoice_date == "")
        {
            alert("Please Enter Date.");
            return false;
        }       
        
        if(income_amount == "")
        {
            alert("Please Enter Amount.");
            return false;
        }     
        
        if(payment_type == "")
        {
            alert("Please Select Payment Type.");
            return false;
        }  
        if(income_description == "")
        {
            alert("Please Enter Description.");
            return false;
        }        
            return true;
    }
</script>

<?php
    include_once('footer.php');
?>