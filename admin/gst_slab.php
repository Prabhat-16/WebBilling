<?php
    include_once('header.php');
    if(isset($_POST['btn_gst']))
    {
        try
        {
        if($_POST['gst_slab_id'] == "")
        {
            //INSERT CODE
            $sql_gst_slab = "CALL insertGst('".$_POST['gst_slab_name']."', '".$_POST['cgst']."', '".$_POST['sgst']."', '".$_POST['igst']."', '".$_SESSION['user_id']."')";

        }
        else
        {
            //UPDATE CODE
            $sql_gst_slab = "CALL updateGst('".$_POST['gst_slab_id']."', '".$_POST['gst_slab_name']."', '".$_POST['cgst']."', '".$_POST['sgst']."', '".$_POST['igst']."', '".$_SESSION['user_id']."')";
        }

        $rs_gst_slab = mysqli_query($con, $sql_gst_slab);
        if(!$rs_gst_slab)
        {
            die('No Record Insert/Updated.'.mysqli_error($con));
        }
        echo "<script>window.location = 'gst_slab.php';</script>";
    } catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('GST Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'gst_slab.php';</script>";
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
            <div class="card-body">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                            <div class="form-section-header">GST Slab Master</div>
                        </div>
                <form action="" method="post" name="frmGstSlab" id="frmGstSlab" >
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                              
                                <input class="form-control" name="gst_slab_name" id="gst_slab_name" type="text">
                                <div class="field-placeholder">Gst Slab Name</div>
                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="cgst" id="cgst">
                                <div class="field-placeholder">CGST</div>
                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="sgst" id="sgst" readonly>
                                <div class="field-placeholder">SGST</div>
                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input class="form-control" type="text" name="igst" id="igst" readonly>
                                <div class="field-placeholder">IGST</div>
                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="gst_slab_id" id="gst_slab_id">
                            <button type="submit" class="btn btn-primary" name="btn_gst" id="btn_gst" onclick="return validate()">Submit</button>
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
                    <div class="form-section-header">GST Slab Data</div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="copy-print-csv" class="table v-middle">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>GST Slab Name</th>
                                <th>CGST</th>
                                <th>SGST</th>
                                <th>IGST</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql_view = "CALL viewGst()";
                            $rs_view = mysqli_query($con, $sql_view);
                            if (!$rs_view) {
                                die('View Not Found.' . mysqli_error($con));
                            }
                            while ($row_view = mysqli_fetch_array($rs_view)) {
                            ?>
                                <tr>

                                    <td>
                                        <div class="actions">
                                            <a href="#" id="<?php echo $row_view['gst_slab_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="icon-edit1 text-info"></i>
                                            </a>
                                            <a href="#" id="<?php echo $row_view['gst_slab_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                <i class="icon-x-circle text-danger"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $row_view['gst_slab_name']; ?></td>
                                    <td><?php echo $row_view['cgst']; ?></td>
                                    <td><?php echo $row_view['sgst']; ?></td>
                                    <td><?php echo $row_view['igst']; ?></td>

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
        // Function to update SGST and IGST fields when CGST value changes
    $('#cgst').on('input', function() {
        var cgstValue = parseFloat($(this).val());
        if (!isNaN(cgstValue)) {
            $('#sgst').val(cgstValue); 
            var sgstValue = parseFloat($('#sgst').val());
            var igstValue = cgstValue + sgstValue; 
            $('#igst').val(igstValue.toFixed(2)); 
        }
    });
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var gst_slab_id = $(this).attr("id");

            // alert(gst_slab_id );

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'gst_slab_delete.php',
                    data: {
                        'id': gst_slab_id ,
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
            var gst_slab_id  = $(this).attr("id");

            // alert(gst_slab_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'gst_slab_fetch.php',
                    data: {
                        'id': gst_slab_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) 
                    {
                        console.log(data.gst_slab_id);
                        document.getElementById("gst_slab_id").value = gst_slab_id;
                        document.getElementById("gst_slab_name").value = data.gst_slab_name;
                        document.getElementById("cgst").value = data.cgst;
                        document.getElementById("sgst").value = data.sgst;
                        document.getElementById("igst").value = data.igst;

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
        var gst_slab_name = document.getElementById("gst_slab_name").value;
        var cgst = document.getElementById("cgst").value;
        var sgst = document.getElementById("sgst").value;
        var igst = document.getElementById("igst").value;
        

        if (gst_slab_name == "") {
            alert('Please Enter GST Name .');
            return false;
        }

        if (cgst == "") {
            alert('Please Enter CGST Name .');
            return false;
        }

        if (sgst == "") {
            alert('Please Enter SGST Name .');
            return false;
        }

        if (igst == "") {
            alert('Please Enter IGST Name .');
            return false;
        }

        return true;
    }
</script>
<?php
    include_once('footer.php');
?>