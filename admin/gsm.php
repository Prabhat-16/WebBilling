<?php
    include_once('header.php');

    if(isset($_POST['btn_gsm']))
    {
        try
        {
        if($_POST['gsm_id'] == "")
        {
            //INSERT CODE
            $sql_gsm= "CALL insertGsm('".$_POST['gsm_name']."', '".$_SESSION['user_id']."')";

        }
        else
        {
            //UPDATE CODE
            $sql_gsm = "CALL updateGsm('".$_POST['gsm_id']."', '".$_POST['gsm_name']."', '".$_SESSION['user_id']."')";
        }

        $rs_gsm = mysqli_query($con, $sql_gsm);
        if(!$rs_gsm)
        {
            die('No Record Insert/Updated.'.mysqli_error($con));
        }
        echo "<script>window.location = 'item.php';</script>";
    }catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('GSM Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'gsm.php';</script>";
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
                    <div class="form-section-header">GSM Master</div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" name="frm_gsm" id="frm_gsm">

                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="gsm_name" id="gsm_name">
                                <div class="field-placeholder">GSM</div>

                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="gsm_id" id="gsm_id">
                            <button type="submit" class="btn btn-primary" name="btn_gsm" id="btn_gsm" onclick="return validate()">Submit</button>
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
                    <div class="form-section-header">GSM Data</div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="copy-print-csv" class="table v-middle">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>GSM Name</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql_view = "CALL viewGsm()";
                            $rs_view = mysqli_query($con, $sql_view);
                            if (!$rs_view) {
                                die('View Not Found.' . mysqli_error($con));
                            }
                            while ($row_view = mysqli_fetch_array($rs_view)) {
                            ?>
                                <tr>

                                    <td>
                                        <div class="actions">
                                            <a href="#" id="<?php echo $row_view['gsm_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="icon-edit1 text-info"></i>
                                            </a>
                                            <a href="#" id="<?php echo $row_view['gsm_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="icon-x-circle text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $row_view['gsm_name']; ?></td>

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
            var gsm_id = $(this).attr("id");

            // alert(gsm_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'gsm_delete.php',
                    data: {
                        'id': gsm_id,
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
            var gsm_id = $(this).attr("id");

            // alert(gsm_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'gsm_fetch.php',
                    data: {
                        'id': gsm_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.gsm_id);
                        document.getElementById("gsm_id").value = gsm_id;
                        document.getElementById("gsm_name").value = data.gsm_name;




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

    function validate() {
        var gsm_name = document.getElementById("gsm_name").value;

        if (gsm_name == "") {
            alert('Please Enter GSM .');
            return false;
        }

        return true;
    }
</script>
<?php
    include_once('footer.php');
?>