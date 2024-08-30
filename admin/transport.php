<?php
    include_once('header.php');
    if(isset($_POST['btn_transport']))
    {
		try
		{
        if ($_POST["transport_id"] == "") 
        {

        if (isset($_POST['is_active'])) {
            $is_active = $_POST['is_active'];
        } else {
            $is_active = 0;
        }
        //INSERT CODE
		$sql_driver= "CALL insertTransport('".$_POST['vehicle_name']."', '".$_POST['vehicle_no']."', '" . $is_active . "','".$_SESSION['user_id']."')";

    } 
    else
    {
        if (isset($_POST['is_active'])) {
            $is_active = $_POST['is_active'];
        } else {
            $is_active = 0;
        }
        //UPDATE CODE
		$sql_driver= "CALL updateTransport('".$_POST['transport_id']."', '".$_POST['vehicle_name']."','".$_POST['vehicle_no']."','" . $is_active . "','".$_SESSION['user_id']."')";
    }

    $rs_driver = mysqli_query($con, $sql_driver);
    if (!$rs_driver)
    {
        die('No Record Insert/Updated.' . mysqli_error($con));
    }
	echo "<script>window.location = 'transport.php';</script>";
}catch (Exception $e) {
	if ($e->getCode() == 1062) { // Duplicate entry error code
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Vehicle Detail Already Exists')";
		echo "</script>";
		echo "<script>window.location = 'transport.php';</script>";
	}
	return $e;
		}
}
?>
<!-- Content wrapper scroll start -->
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
							<div class="form-section-header">Transport Master</div>
						</div>
					</div>
					<div class="card-body mt-4">
					<form action="" method="post" name="frmTransport" id="frmTransport" enctype="multipart/form-data">


						<!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

								<!-- Field wrapper start -->
								<div class="field-wrapper">
									<input type="text" class="form-control" name="vehicle_name" id="vehicle_name" require>
									<div class="field-placeholder">Vehicle Name</div>
								</div>
								<!-- Field wrapper end -->

							</div>
                            
                            
							
									
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<!-- Field wrapper start -->
										<div class="field-wrapper">
											<input type="text" class="form-control" name="vehicle_no" id="vehicle_no" require>
											<div class="field-placeholder">Vehicle no.</div>
										</div>
										<!-- Field wrapper end -->
							</div>
					

							

							<div class="col-4" style="margin-top: 20px;">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
											<label class="form-check-label" for="flexCheckDefault">
												IS ACTIVE
											</label>
										</div>
							</div>

							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
								<input type="hidden" name="transport_id" id="transport_id"/>
								<button type="submit" name="btn_transport" id="btn_transport" class="btn btn-primary mb-3" onclick="return validate()">Submit</button>
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
					<div class="form-section-header">Transport Data</div>
				</div>

				<div class="table-responsive">
					<table id="copy-print-csv" class="table v-middle">
						<thead>
							<tr>
								<th>Actions</th>
								<th>Vehicle Name</th>
								<th>Vehicle no.</th>
								<th>Active Staus</th>
								<th>Added Date</th>
							</tr>
						</thead>
						<tbody>

							<?php
							// VIEW GST SLAB CODE START

							$sql_view = "CALL viewTransport()";
							$rs_view = mysqli_query($con, $sql_view);

							while ($row_transport = mysqli_fetch_array($rs_view)) {
							?>

								<tr>
									<td>
										<div class="actions">
											<a href="" class="btn_edit" id="<?php echo $row_transport['transport_id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
												<i class="icon-edit1 text-info"></i>
											</a>
											<a href="" class="btn_delete" id="<?php echo $row_transport['transport_id'] ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
												<i class="icon-x-circle text-danger"></i>
											</a>
										</div>
									
									<td><?php echo $row_transport['vehicle_name']; ?></td>
									<td><?php echo $row_transport['vehicle_no']; ?></td>
									

									<td>
										<?php
										$is_active = $row_transport['is_active'];
										if ($is_active == 1) {
											echo '<span class="badge bg-success">Active</span>';
										} else {
											echo '<span class="badge bg-danger">InActive</span>';
										}
										?>

									</td>

									</td>

									<td><?php echo date("d-m-Y", strtotime($row_transport['added_date'])); ?></td>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var transport_id   = $(this).attr("id");

            //   alert(transport_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'transport_delete.php',
                    data: {
                        'id': transport_id   ,
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
            var transport_id    = $(this).attr("id");

            //  alert(transport_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'transport_fetch.php',
                    data: {
                        'id': transport_id  ,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) 
                    {
                        console.log(data.transport_id);
                    document.getElementById("transport_id").value = transport_id;
                    document.getElementById("vehicle_name").value = data.vehicle_name;
					document.getElementById("vehicle_no").value = data.vehicle_no;

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

	function validate(){
		var vehicle_name =document.getElementById("vehicle_name").value;
        var vehicle_name_in = /^[A-Za-z ]+$/;

		var vehicle_no =document.getElementById("vehicle_no").value;

		if(vehicle_name == "")
        {
            alert("Please Enter Vehicle Name ");
			return false;
        }
        if(!vehicle_name.match(vehicle_name_in))
		{
			alert("Invalid Driver Name.");
			return false;
		}
		if(vehicle_no == "")
        {
            alert("Please Enter Vehicle No ");
			return false;
        }
		return true;
	}
</script>
<!-- Row end -->
<?php
    include_once('footer.php');
?>