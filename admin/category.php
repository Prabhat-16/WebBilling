<?php
include_once('header.php');
if (isset($_POST['btn_category'])) 
{
    try
    {
        if ($_POST["category_id"] == "") 
        {
            if (isset($_POST['is_active'])) 
            {
                $is_active = $_POST['is_active'];
            } else 
            {
                $is_active = 0;
            }
            //INSERT CODE
            $sql_category = "CALL insertCategory('" . $_POST['category_code'] . "', '" . $_POST['category_name'] . "','" . $is_active . "','" . $_SESSION['user_id'] . "')";
        }
            else 
        {
            if (isset($_POST['is_active'])) 
            {
                $is_active = $_POST['is_active'];
            } 
                else 
            {
                $is_active = 0;
            }
            //UPDATE CODE
            $sql_category = "CALL updateCategory('" . $_POST['category_id'] . "', '" . $_POST['category_code'] . "', '" . $_POST['category_name'] . "','" . $is_active . "','" . $_SESSION['user_id'] . "')";
        }
        

        $rs_category = mysqli_query($con, $sql_category);
         
        if (!$rs_category) 
        {
                die('No Record Insert/Updated.' . mysqli_error($con));   
        } 
        echo "<script>window.location = 'item.php';</script>";
        
    }
    catch (Exception $e)
    {

        // print_r($e->getCode() );

        if ($e->getCode() == 1062) { // Duplicate entry error code
            echo "<script language='javascript' type='text/javascript'>";   
            echo "alert('Category Already Exists')";
            echo"</script>";
            echo "<script>window.location = 'category.php';</script>";
        } 
        return $e;
    }   
}

?>

<!-- Rest of your HTML code -->



<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">

        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">Category Master</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frm_category" id="frm_category">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="text" name="category_code" id="category_code" required>
                                    <div class="field-placeholder">Category Code</div>

                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="text" name="category_name" id="category_name">
                                    <div class="field-placeholder">Category Name</div>

                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">

                            <div class="col-6" style="margin-top: 20px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        IS ACTIVE
                                    </label>
                                </div>
                            </div>

                            </div>




                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                <input type="hidden" name="category_id" id="category_id">
                                <button type="submit" class="btn btn-primary" name="btn_category" id="btn_category" onclick="return validate()">Submit</button>
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
                        <div class="form-section-header">Category Data</div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Category Code</th>
                                    <th>Category Name</th>
                                    <th>Active Status</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewCategory()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                ?>
                                    <tr>

                                        <td>
                                            <div class="actions">
                                                <a href="#" id="<?php echo $row_view['category_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="#" id="<?php echo $row_view['category_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo $row_view['category_code']; ?></td>
                                        <td><?php echo $row_view['category_name']; ?></td>




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

</div>
<!-- Content wrapper end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    //Fetch User Data By Id
    $('.btn_edit').click(function(e) {
                e.preventDefault();
                var category_id = $(this).attr("id");

                if (confirm("are you really want to edit this?")) {
                    $.ajax({
                            url: 'Category_fetch.php',
                            data: {
                                'id': category_id,
                                'edit': 1
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(data) {
                                console.log(data.category_id);
                                document.getElementById("category_id").value = category_id;
                                document.getElementById("category_code").value = data.category_code;
                                document.getElementById("category_name").value = data.category_name;
                                // document.getElementById("is_active").value = data.is_active;

                                if (data.is_active == 1) {
                                    $('#is_active').prop('checked', true);
                                } else {
                                    $('#is_active').prop('checked', false);
                                }



                                },
                                error: function(data) {
                                    console.log('my ERROR' + data.d);
                                }
                            });
                    }
                    else {
                        return false;
                    }

                });

            $('.btn_delete').click(function(e) {
                e.preventDefault();
                var category_id = $(this).attr("id");

                // alert(category_id);

                if (confirm("Are you Sure You Want to Delete?")) {
                    $.ajax({
                        url: 'Category_delete.php',
                        data: {
                            'id': category_id,
                            'delete': 1
                        },
                        type: "POST",
                        success: function(output) {
                            window.location.reload();
                        }
                    });
                } else {
                    return false;
                }
            });

    function validate()
    {
        var category_code = document.getElementById("category_code").value;

        var category_name = document.getElementById("category_name").value;
        var category_name_in = /^[A-Za-z ]+$/;


        if(category_code == "")
        {
            alert('Please Enter Category Code.');
            return false;
        }

        if(category_name == "")
        {
            alert("Please Enter Category Name");
            return false;
        }
        if(!category_name.match(category_name_in))
        {
            alert("Invalid Category Name.");
            return false;
        }

        return true;
    }
</script>

<?php
include_once('footer.php');
?>