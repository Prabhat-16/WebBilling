<?php
    include_once('header.php');

    if(isset($_POST['btn_driver']))
    {
        try
        {
        if ($_POST["driver_id"] == "") 
        {
    
            if (isset($_POST['is_active'])) {
                $is_active = $_POST['is_active'];
            } else {
                $is_active = 0;
            }
            //INSERT CODE
            $sql_driver= "CALL insertDriver('".$_POST['driver_name']."', '".$_POST['mobile']."' ,'".$_POST['email']."', '" . $is_active . "','".$_SESSION['user_id']."')";
    
        } 
        else
        {
            if (isset($_POST['is_active'])) {
                $is_active = $_POST['is_active'];
            } else {
                $is_active = 0;
            }
            //UPDATE CODE
            $sql_driver= "CALL updateDriver('".$_POST['driver_id']."', '".$_POST['driver_name']."', '".$_POST['mobile']."','".$_POST['email']."','" . $is_active . "','".$_SESSION['user_id']."')";
        }
    
        $rs_driver = mysqli_query($con, $sql_driver);
        if (!$rs_driver)
        {
            die('No Record Insert/Updated.' . mysqli_error($con));
        }
        echo "<script>window.location = 'driver.php';</script>";
    }catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Driver Detail Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'driver.php';</script>";
        }
        return $e;
    }
    }
?>
<div class="content-wrapper-scroll">

<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Driver Master</div>
                    </div>
                </div>
                <div class="card-body mt-4">
                <form action="" method="post" name="frmDriver" id="frmDriver" enctype="multipart/form-data">


                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">

                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                                <input type="text" class="form-control" name="driver_name" id="driver_name" require>
                                <div class="field-placeholder">Driver Name</div>
                            </div>
                            <!-- Field wrapper end -->

                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="email" class="form-control" name="email" id="email" require>
                                        <div class="field-placeholder">Email</div>
                                    </div>
                                    <!-- Field wrapper end -->
                        </div>
                        
                                
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="numbetr" class="form-control" name="mobile" id="mobile" require>
                                        <div class="field-placeholder">Contact No</div>
                                    </div>
                                    <!-- Field wrapper end -->
                        </div>
                

                        

                        <div class="col-6" style="margin-top: 20px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            IS ACTIVE
                                        </label>
                                    </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="driver_id" id="driver_id"/>
                            <button type="submit" name="btn_driver" id="btn_driver" class="btn btn-primary mb-3" onclick="return validate()">Submit</button>
                            <button type="reset" name="btnreset" id="btnreset" class="btn btn-light mb-3">Cancel</button>
                        </div>
                    </form>


                    </div>
                    <!-- Row end -->

                </div>
            </div>
            <!-- Card end -->


            <div class="row gutters">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    <div class="card">
        <div class="card-body">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                <div class="form-section-header">Driver Data</div>
            </div>

            <div class="table-responsive">
                <table id="copy-print-csv" class="table v-middle">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Driver Name</th>
                            <th>Driver Email</th>
                            <th>Driver Phone</th>
                            <th>Active Status</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // VIEW GST SLAB CODE START

                        $sql_view = "CALL viewDriver()";
                        $rs_view = mysqli_query($con, $sql_view);

                        while ($row_driver = mysqli_fetch_array($rs_view)) {
                        ?>

                            <tr>
                                <td>
                                    <div class="actions">
                                        <a href="" class="btn_edit" id="<?php echo $row_driver['driver_id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                            <i class="icon-edit1 text-info"></i>
                                        </a>
                                        <a href="" class="btn_delete" id="<?php echo $row_driver['driver_id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                            <i class="icon-x-circle text-danger"></i>
                                        </a>
                                    </div>
                                
                               
                                <td><?php echo $row_driver['driver_name']; ?></td>
                                <td><?php echo $row_driver['email']; ?></td>
                                <td><?php echo $row_driver['mobile']; ?></td>
                                
                        
                                <td>
                                    <?php
                                    $is_active = $row_driver['is_active'];
                                    if ($is_active == 1) {
                                        echo '<span class="badge bg-success">Active</span>';
                                    } else {
                                        echo '<span class="badge bg-danger">InActive</span>';
                                    }
                                    ?>

                                </td>

                                </td>

                                <td><?php echo date("d-m-Y", strtotime($row_driver['added_date'])); ?></td>

                            </tr>

                        <?php
                        }

                        // VIEW GST SLAB CODE START
                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
</div>
<!-- Row end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var driver_id  = $(this).attr("id");

            //   alert(driver_id );

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'driver_delete.php',
                    data: {
                        'id': driver_id  ,
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
            var driver_id    = $(this).attr("id");

             alert(driver_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'driver_fetch.php',
                    data: {
                        'id': driver_id ,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) 
                    {
                        console.log(data.driver_id);
                    document.getElementById("driver_id").value = driver_id;
                    document.getElementById("driver_name").value = data.driver_name;
					document.getElementById("mobile").value = data.mobile;
					document.getElementById("email").value = data.email;


					if (data.is_active == 1) {
                                    $('#is_active').prop('checked', true);
                                } else {
                                    $('#is_active').prop('checked', false);
                                }


                    },
                    error: function(data) 
                    {
                        console.log('my ERROR' + data.d);
                    }
                });
            } else {
                return false;
            }
        });
    });

    function validate()
    {
        var driver_name =document.getElementById("driver_name").value;
        var driver_name_in = /^[A-Za-z ]+$/;

        var email = document.getElementById("email").value;
		var email_in =  /\S+@\S+\.\S+/;

        var contact_no =document.getElementById("mobile").value;
        var contact_no_in = /^\d{10}$/;

        if(driver_name == "")
        {
            alert("Please Enter Driver Name ");
			return false;
        }
        if(!driver_name.match(driver_name_in))
		{
			alert("Invalid Driver Name.");
			return false;
		}

        if(email == "")
		{
			alert("Please  Enter Email.");
			return false;
		}	
		
		if(!email.match(email_in))
		{
			alert("Invalid Email.");
			return false;
		}

        if(contact_no == "")
		{
			alert("Please Enter Contact No");
			return false;
		}
		if(!contact_no.match(contact_no_in))
		{
			alert("Invalid Phone number Must Be 10 Digits.");
			return false;
		}

        return true;
    }
</script>
<?php
    include_once('footer.php');
?>