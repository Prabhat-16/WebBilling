<?php
include_once('header.php');
if (isset($_POST['btn_quality'])) {
    try {
        if ($_POST['quality_id'] == "") {
            //INSERT CODE
            $sql_quality = "CALL insertQuality('" . $_POST['quality_name'] . "', '" . $_SESSION['user_id'] . "')";
        } else {
            //UPDATE CODE
            $sql_quality = "CALL updateQuality('" . $_POST['quality_id'] . "', '" . $_POST['quality_name'] . "', '" . $_SESSION['user_id'] . "')";
        }

        $rs_quality = mysqli_query($con, $sql_quality);
        if (!$rs_quality) {
            die('No Record Insert/Updated.' . mysqli_error($con));
        }
        echo "<script>window.location = 'quality.php';</script>";
    } catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Quality Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'quality.php';</script>";
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
                        <div class="form-section-header">Quality Master</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frm_quality" id="frm_quality">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="text" name="quality_name" id="quality_name" required>
                                    <div class="field-placeholder">Quality</div>

                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                <input type="hidden" name="quality_id" id="quality_id">
                                <button type="submit" class="btn btn-primary" name="btn_quality" id="btn_quality" onclick="return validate()">Submit</button>
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
                        <div class="form-section-header">Quality Data</div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Quality Name</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewQuality()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                ?>
                                    <tr>

                                        <td>
                                            <div class="actions">
                                                <a href="#" id="<?php echo $row_view['quality_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="#" id="<?php echo $row_view['quality_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $row_view['quality_name']; ?></td>

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
            var quality_id = $(this).attr("id");

            // alert(quality_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'quality_delete.php',
                    data: {
                        'id': quality_id,
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
            var quality_id = $(this).attr("id");

            // alert(quality_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'quality_fetch.php',
                    data: {
                        'id': quality_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.quality_id);
                        document.getElementById("quality_id").value = quality_id;
                        document.getElementById("quality_name").value = data.quality_name;




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
        var quality_name = document.getElementById("quality_name").value;

        if (quality_name == "") {
            alert('Please Enter Quality .');
            return false;
        }

        return true;
    }
</script>
<?php
include_once('footer.php');
?>