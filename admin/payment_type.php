<?php
    include_once('header.php');
    if(isset($_POST['btn_payment']))
    {
        try
        {
        if ($_POST['payment_type_id'] == "") {
            //INSERT CODE
            $sql_payment = "CALL insertPaymentType('" . $_POST['payment_type'] . "', '" . $_SESSION['user_id'] . "')";
        } else {
            //UPDATE CODE
            $sql_payment = "CALL updatePaymentType('" . $_POST['payment_type_id'] . "', '" . $_POST['payment_type'] . "', '" . $_SESSION['user_id'] . "')";
        }
    
        $rs_payment = mysqli_query($con, $sql_payment);
        if (!$rs_payment) {
            die('No Record Insert/Updated.' . mysqli_error($con));
        }
        echo "<script>window.location = 'payment_type.php';</script>";
    }catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Payment Type  Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'payment_type.php';</script>";
        }
        return $e;
    }
}
?>
<div class="content-wrapper">

<!-- Row start -->
<div class="row gutters">

    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">

        <!-- Card start -->
        <div class="card">
            <div class="card-header">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Payment Type</div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" name="frm_payment_type" id="frm_payment_type">

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="payment_type" id="payment_type" required>
                                <div class="field-placeholder">Payment Type</div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="payment_type_id" id="payment_type_id">
                            <button type="submit" class="btn btn-primary" name="btn_payment" id="btn_payment" onclick="return validate()">Submit</button>
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
<!-- Row end -->
<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


        <div class="card">
            <div class="card-header">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">Payment Type Data</div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="copy-print-csv" class="table v-middle">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Payment Type</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql_view = "CALL viewPaymentType()";
                            $rs_view = mysqli_query($con, $sql_view);
                            if (!$rs_view) {
                                die('View Not Found.' . mysqli_error($con));
                            }
                            while ($row_view = mysqli_fetch_array($rs_view)) {
                            ?>
                                <tr>

                                    <td>
                                        <div class="actions">
                                            <a href="#" id="<?php echo $row_view['payment_type_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="icon-edit1 text-info"></i>
                                            </a>
                                            <a href="#" id="<?php echo $row_view['payment_type_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="icon-x-circle text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $row_view['payment_type']; ?></td>

                                    <td><?php echo date("d-m-Y", strtotime($row_view['added_date'])); ?></td>

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
            var payment_type_id  = $(this).attr("id");

            // alert(payment_type_id );

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'payment_type_delete.php',
                    data: {
                        'id': payment_type_id,
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
            var payment_type_id = $(this).attr("id");

            // alert(payment_type_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'payment_type_fetch.php',
                    data: {
                        'id': payment_type_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) 
                    {
                        console.log(data.gsm_id);
                        document.getElementById("payment_type_id").value = payment_type_id;
                        document.getElementById("payment_type").value = data.payment_type;
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

    function validate(){
        var payment_type =document.getElementById("payment_type").value;

        if(payment_type == "")
        {
            alert("Please Enter Payment Type ");
			return false;
        }
		return true;
    }
</script>
<?php
    include_once('footer.php');
?>