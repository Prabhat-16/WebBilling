<?php
include_once('header.php');

if(isset($_POST['btn_party']))
{
    try
    {
    if ($_POST["party_id"] == "") 
    {

        if (isset($_POST['is_active'])) {
            $is_active = $_POST['is_active'];
        } else {
            $is_active = 0;
        }
        //INSERT CODE
		$sql_party= "CALL insertParty('".$_POST['party_name']."', '".$_POST['party_type']."', '".$_POST['contact_no']."', '".$_POST['email']."', '".$_POST['op_balance']."', '".$_POST['address']."', '".$_POST['discount']."', '".$_POST['state']."', '".$_POST['gstin']."','".$_POST['penalty']."','".$_POST['credit_period']."','" . $is_active . "','".$_SESSION['user_id']."')";
        // echo $sql_party ;

    } 
    else
    {
        if (isset($_POST['is_active'])) {
            $is_active = $_POST['is_active'];
        } else {
            $is_active = 0;
        }
        //UPDATE CODE
		$sql_party= "CALL updateParty('".$_POST['party_id']."','".$_POST['party_name']."', '".$_POST['party_type']."', '".$_POST['contact_no']."', '".$_POST['email']."', '".$_POST['op_balance']."', '".$_POST['address']."', '".$_POST['discount']."', '".$_POST['state']."', '".$_POST['gstin']."','".$_POST['penalty']."','".$_POST['credit_period']."','" . $is_active . "','".$_SESSION['user_id']."')";
        // echo $sql_party ;
    }

    $rs_party = mysqli_query($con, $sql_party);
    if (!$rs_party)
    {
        die('No Record Insert/Updated.' . mysqli_error($con));
    }
    echo "<script>window.location = 'party.php';</script>";
    }catch (Exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('Party Detail Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'party.php';</script>";
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
                            <div class="form-section-header">Party Master</div>
                        </div>
                    </div>
                    <div class="card-body mt-4">
                        <form action="" method="post" name="frmParty" id="frmParty" enctype="multipart/form-data">


                            <!-- Row start -->
                            <div class="row gutters">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="text" class="form-control" name="party_name" id="party_name" require>
                                        <div class="field-placeholder">Party Name</div>
                                    </div>
                                    <!-- Field wrapper end -->

                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <select name="party_type" id="party_type">
                                            <option value="" selected>--Select--</option>
                                            <option value="Supplier">Supplier</option>
                                            <option value="Customer">Customer</option>
                                        </select>

                                        <div class="field-placeholder">Party Type</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="numbetr" class="form-control" name="contact_no" id="contact_no" require>
                                        <div class="field-placeholder">Contact No</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="email" class="form-control" name="email" id="email" require>
                                        <div class="field-placeholder">Email</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <textarea name="address" id="address" rows="1"="form-control" require></textarea>
                                        <div class="field-placeholder">Address</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="number" class="form-control" name="op_balance" id="op_balance" require>
                                        <div class="field-placeholder">Opening Balance</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>



                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="text" class="form-control" name="discount" id="discount" require>
                                        <div class="field-placeholder">Discount</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <select name="state" id="state">
                                            <option value="" selected>Select</option>
                                            <?php
                                            $sql_state = "SELECT * FROM tbl_state";
                                            $rs_state = mysqli_query($con, $sql_state);
                                            if (!$rs_state) {
                                                die('No State Found.' . mysqli_error($con));
                                            }
                                            while ($row_state = mysqli_fetch_array($rs_state)) {
                                            ?>
                                                <option value="<?php echo $row_state['state_id']; ?>"><?php echo $row_state['state_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <div class="field-placeholder">State</div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="text" class="form-control" name="gstin" id="gstin" require>
                                        <div class="field-placeholder">GST </div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                        <input type="number" class="form-control" name="penalty" id="penalty" require>
                                        <div class="field-placeholder">Penalty </div>
                                    </div>
                                    <!-- Field wrapper end -->
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <!-- Field wrapper start -->
                                    <div class="field-wrapper">
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="credit_period" id="credit_period">
                                        <span class="input-group-text">
                                           Days
                                        </span>
                                    </div>
                                    <div class="field-placeholder">Credit Period</div>
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
                                    <input type="hidden" name="party_id" id="party_id" />
                                    <button type="submit" name="btn_party" id="btn_party" class="btn btn-primary mb-3" onclick="return validate()">Submit</button>
                                    <button type="reset" name="btn_reset" id="btn_reset" class="btn btn-light mb-3">Cancel</button>
                                </div>
                        </form>


                    </div>
                    <!-- Row end -->

                </div>
            </div>
            <!-- Card end -->

            <!-- Row start -->
            <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Party Data</div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Party Name</th>
                                    <th>Party Type</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Op Balance</th>
                                    <th>Discount</th>
                                    <th>State</th>
                                    <th>GST</th>
                                    <th>Penalty</th>
                                    <th>Credit Period</th>
                                    <th>Active Status</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewParty()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                ?>
                                    <tr>

                                        <td>
                                            <div class="actions">
                                                <a href="#" id="<?php echo $row_view['party_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="#" id="<?php echo $row_view['party_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $row_view['party_name']; ?></td>
                                        <td><?php echo $row_view['party_type']; ?></td>
                                        <td><?php echo $row_view['contact_no']; ?></td>
                                        <td><?php echo $row_view['email']; ?></td>
                                        <td><?php echo $row_view['address']; ?></td>
                                        <td><?php echo $row_view['op_balance']; ?></td>
                                        <td><?php echo $row_view['discount']; ?></td>
                                        <td><?php echo $row_view['state_name']; ?></td>
                                        <td><?php echo $row_view['gstin']; ?></td>
                                        <td><?php echo $row_view['penalty']; ?></td>
                                        <td><?php echo $row_view['credit_period']; ?></td>

                                        <td>
                                            <?php
                                            $is_active = $row_view['is_active'];

                                            if ($is_active == 1) {
                                                echo '<span class="badge bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">InActive</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($row_view['added_date']));?></td>

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
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var party_id    = $(this).attr("id");

            //  alert(party_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'party_delete.php',
                    data: {
                        'id': party_id ,
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
            var party_id   = $(this).attr("id");

            // alert(party_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'party_fetch.php',
                    data: {
                        'id': party_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) 
                    {
                        console.log(data.party_id);
                    document.getElementById("party_id").value = party_id;
                    document.getElementById("party_name").value = data.party_name;
					document.getElementById("party_type").value = data.party_type;
					document.getElementById("contact_no").value = data.contact_no;
					document.getElementById("email").value = data.email;
					document.getElementById("op_balance").value = data.op_balance;
					document.getElementById("address").value = data.address;
					document.getElementById("discount").value = data.discount;
					document.getElementById("state").value = data.state_id;
					document.getElementById("gstin").value = data.gstin;
                    document.getElementById("penalty").value = data.penalty;
                    document.getElementById("credit_period").value = data.credit_period;


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
        var party_name =document.getElementById("party_name").value;
        var party_name_in = /^[A-Za-z ]+$/;

        var party_type = document.getElementById("party_type").value;

        var contact_no =document.getElementById("contact_no").value;
        var contact_no_in = /^\d{10}$/;

        var email = document.getElementById("email").value;
		var email_in =  /\S+@\S+\.\S+/;

        var address = document.getElementById("address").value;


        var op_balance = document.getElementById("op_balance").value;

    

        var discount = document.getElementById("discount").value;

        var state = document.getElementById("state").value;
        
        var gstin = document.getElementById("gstin").value;


        if(party_name == "")
		{
			alert("Please Enter Party Name ");
			return false;
		}
		if(!party_name.match(party_name_in))
		{
			alert("Invalid Party Name.");
			return false;
		}
        if(party_type == "")
		{
			alert("Please Select Party Type.");
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
		

		if(address == "")
		{
			alert("Please Enter address.");
			return false;
		}	
        if(op_balance == "")
		{
			alert("Please Enter Opening Balance.");
			return false;
		}	

		if(discount == "")
		{
			alert("Please Enter discount.");
			return false;
		}	
        if(state == "")
		{
			alert("Please Select State ");
			return false;
		}

		if(gstin == "")
		{
			alert("Please Enter gstin ");
			return false;
		}

       

		return true;
    }


</script>
<?php
include_once('footer.php');
?>