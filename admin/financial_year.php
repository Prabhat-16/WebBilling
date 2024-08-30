<?php
include_once('header.php');

if (isset($_POST['btn_year'])) 
{
    // echo "Button Clicked...";

    $financial_year = $_POST['fianacial_year'];
    $fy = explode("-", $financial_year);

    $start_date = $fy[0] . "-04-01";
    $end_date = $fy[1] . "-03-31";

    // $is_default = isset($_POST['is_default']) ? $_POST['is_default'] : 0;

    // echo $_POST['is_default']; 

    if (isset($_POST['is_default'])) 
    {
        $is_default = 1;
    } else 
    {
        $is_default = 0;
    }

    // echo $is_default;


    $sql_fy = "INSERT INTO tbl_financial_year (financial_year, start_date, end_date, is_default, created_by) VALUE ('" . $_POST['fianacial_year'] . "','" . $start_date . "','" . $end_date . "','" . $is_default . "','" . $_SESSION['user_id'] . "')";


    $rs_fy = mysqli_query($con, $sql_fy);
    $last_id = mysqli_insert_id($con);
    echo $last_id;
    if (!$rs_fy) 
    {
        die('Financial Year not Inserted/Updated.' . mysqli_error($con));
    }

    if ($is_default == 1) 
    {
        // $id =  last_insert_id();;

        // echo $id;

        $set_default = "UPDATE tbl_financial_year SET is_default = 0 WHERE financial_year_id NOT IN ('" . $last_id . "') ";
        mysqli_query($con, $set_default);
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
                        <div class="form-section-header">Financial Year Master</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frm_financial" id="frm_financial">

                        <!-- Row start -->
                        <div class="row gutte   rs">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">


                                <div class="field-wrapper">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="current_year" name="current_year" onchange="getFinancialYear()" onkeypress="getFinancialYear()">

                                        <!-- <span class="input-group-text">
                                            <i class="icon-calendar1"></i>
                                        </span> -->
                                    </div>
                                    <div class="field-placeholder">Current Year</div>
                                </div>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="field-wrapper">
                                    <div class="input-group">
                                        <input type="text" class="form-control " name="fianacial_year" id="fianacial_year">
                                        <!-- <span class="input-group-text">
                                            <i class="icon-calendar1"></i>
                                        </span> -->
                                    </div>
                                    <div class="field-placeholder">Financial Year</div>
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="form-check" style="margin: 18px;">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_default" name="is_default">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        SET AS DEFAULT
                                    </label>
                                </div>

                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                <input type="hidden" name="financial_year_id" id="financial_year_id">
                                <button type="submit" name="btn_year" id="btn_year" class="btn btn-primary">Submit</button>
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

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Financial Year Data</div>
                    </div>

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Financial Year</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Is Default</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewFinancialYear()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                while ($row_view = mysqli_fetch_array($rs_view)) 
                                {
                                ?>
                                    <tr>

                                        <td>
                                            <div class="actions">
                                                <a href="#" id="<?php echo $row_view['financial_year_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-verified_user text-info"></i>
                                                </a>
                                                <a href="#" id="<?php echo $row_view['financial_year_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $row_view['financial_year']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row_view['start_date'])); ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row_view['end_date'])); ?></td>
                                        <td>
                                            <?php
                                            $is_active = $row_view['is_default'];

                                            if ($is_active == 1) {
                                                echo '<span class="badge bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge bg-danger">InActive</span>';
                                            }
                                            ?>
                                        </td>


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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() 
    {
        $.ajax({
            url: "financial_year.php",
            context: document.body,
            success: function() {
                //    alert("done");
                var year = new Date().getFullYear();
                //    alert(year);
                document.getElementById("current_year").value = year;
                getFinancialYear();

            }
        });
    });


    $('.btn_delete').click(function(e) 
    {
        e.preventDefault();
        var financial_year_id = $(this).attr("id");

        // alert(financial_year_id);

        if (confirm("Are you Sure you Want to Delete this?")) {
            $.ajax({
                url: 'fy_delete.php',
                data: {
                    'id': financial_year_id,
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


    $('.btn_edit').click(function(e) 
    {
        e.preventDefault();
        var financial_year_id = $(this).attr("id");

        // alert(financial_year_id);

        if (confirm("Are you Sure you Want to Set Default this Financial Year ?")) {
            $.ajax({
                url: 'fy_fetch.php',
                data: {
                    'id': financial_year_id,
                    'edit': 1
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


    function getFinancialYear() 
    {
        var today = new Date();
        // Get the current month.  

        var curMonth = today.getMonth();
       

        var fy = document.getElementById("current_year").value;

        // alert(fy);

        var fiscalYr = "";
        // fiscalYr = fy + "-" + (  fy + 1); 


        if (curMonth > 3) {
            // alert("IF");
            fiscalYr = fy + "-" + (fy + 1);
        } else {
            // alert("ELSE"); 
            fiscalYr = (fy - 1) + "-" + fy;
        }

        // Return the financial year.  
        // alert(fiscalYr);

        document.getElementById("fianacial_year").value = fiscalYr;
    }
</script>

<?php
include_once('footer.php');
?>