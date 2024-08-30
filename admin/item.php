    <?php
    include_once('header.php');

    $uploadDir = '../images/item/';

    $allowTypes = array('jpg', 'png', 'jpeg');

    if (isset($_POST['btn_item'])) 
    {
        try {
            // echo"Hello Last King";


            $uploadedFile = '';
            // Check if a file is uploaded
            if (!empty($_FILES["item_photo"]["name"])) 
            {
                $fileName = basename($_FILES["item_photo"]["name"]);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Check if the file type is allowed
                if (in_array($fileType, $allowTypes)) 
                {
                    // Upload file to the server
                    if (move_uploaded_file($_FILES["item_photo"]["tmp_name"], $targetFilePath)) 
                    {
                        $uploadedFile = $fileName;
                    } 
                        else 
                    {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                    }
                } 
                    else 
                {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
                }
            }
            // $size_name = implode(",",$_POST['size_name']);

            if ($_POST['item_id'] == "") 
            {
                // Inserting multiple sizes
                if (isset($_POST['size_name']) && is_array($_POST['size_name']) && !empty($_POST['size_name'])) 
                {
                    $size_name = implode(",", $_POST['size_name']);
                } 
                    else 
                {
                    // Handle the case where size_name is not set or empty
                }

                // Inserting multiple GSMs
                if (isset($_POST['gsm_name']) && is_array($_POST['gsm_name']) && !empty($_POST['gsm_name'])) 
                {
                    $gsm_name = implode(",", $_POST['gsm_name']);
                    // Further processing using $size_name...
                } 
                    else 
                {
                }

                $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
                $sql_item = "CALL insertItem('" . $_POST['item_name'] . "','" . $_POST['quality_name'] . "','" . $_POST['category_name'] . "','" . $size_name . "','" . $gsm_name . "','".$_POST['gst_name']."','" . $_POST['quantity'] . "','" . $_POST['amount'] . "','" . $_POST['op_stock'] . "','" . $is_active . "','" . $uploadedFile . "','" . $_SESSION['user_id'] . "')";
                // echo $sql_item;
            } 
                else 
            {
                if (isset($_POST['size_name']) && is_array($_POST['size_name']) && !empty($_POST['size_name'])) {
                    $size_name = implode(",", $_POST['size_name']);
                } 
                    else 
                {
                    // Handle the case where size_name is not set or empty
                }

                // Inserting multiple GSMs
                if (isset($_POST['gsm_name']) && is_array($_POST['gsm_name']) && !empty($_POST['gsm_name'])) 
                {
                    $gsm_name = implode(",", $_POST['gsm_name']);
                    // Further processing using $size_name...
                } 
                    else 
                {
                }
              
                $sql = "SELECT item_photo FROM tbl_item WHERE item_id = '" . $_POST['item_id'] . "'";
                $rs = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($rs);
                $existing_image = $row['item_photo'];

                // Check if a new image is uploaded
                if (!empty($_FILES["item_photo"]["name"])) {
                    // New image is uploaded, update with the new image
                    $fileName = basename($_FILES["item_photo"]["name"]);
                    $targetFilePath = $uploadDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                    // Check if the file type is allowed
                    if (in_array($fileType, $allowTypes)) 
                    {
                        // Upload file to the server
                        if (move_uploaded_file($_FILES["item_photo"]["tmp_name"], $targetFilePath)) 
                        {
                            // Delete old image if it exists
                            if (!empty($existing_image)) {
                                $oldFilePath = $uploadDir . $existing_image;
                                if (file_exists($oldFilePath)) 
                                {
                                    unlink($oldFilePath);
                                }
                            }
                            $uploadedFile = $fileName;
                        } 
                            else 
                        {
                            $uploadStatus = 0;
                            $response['message'] = 'Sorry, there was an error uploading your file.';
                        }
                    } 
                        else 
                    {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
                    }
                } 
                    else 
                {
                    // No new image uploaded, retain the existing image
                    $uploadedFile = $existing_image;
                }
                $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
                $sql_item = "CALL updateItem('" . $_POST['item_id'] . "','" . $_POST['item_name'] . "','" . $_POST['quality_name'] . "','" . $_POST['category_name'] . "','" . $size_name . "','" . $gsm_name . "', '".$_POST['gst_name']."','" . $_POST['quantity'] . "','" . $_POST['amount'] . "','" . $_POST['op_stock'] . "','" . $is_active . "','" . $uploadedFile . "','" . $_SESSION['user_id'] . "')";
                //  echo $sql_item ;
            }
            $rs_item = mysqli_query($con, $sql_item);
            if (!$rs_item) 
            {
                die('No Item Inserted/Updated.' . mysqli_error($con));
            }
             echo "<script>window.location = 'item.php';</script>";
        } catch (Exception $e) 
        {
            if ($e->getCode() == 1062) 
            {
                echo "<script language='javascript' type='text/javascript'>";
                echo "alert('Item Name  Already Exists')";
                echo "</script>";
                echo "<script>window.location = 'item.php';</script>";
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
                            <div class="form-section-header">Item Master</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" name="frm_item" id="frm_item" enctype="multipart/form-data">

                            <!-- Row start -->
                            <div class="row gutters">

                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                    <div class="row gutters">
                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <select class="" name="category_name" id="category_name" onchange="if(this.value=='category.php')    getCategory()">

                                                    <option value="" selected>--Select--</option>
                                                    <?php
                                                    $sql_category = "SELECT * FROM tbl_category";
                                                    $rs_category =  mysqli_query($con, $sql_category);
                                                    if (!$rs_category) 
                                                    {
                                                        die('No Category Found.' . mysqli_error($con));
                                                    }
                                                    while ($row_category = mysqli_fetch_array($rs_category)) 
                                                    {
                                                    ?>
                                                        <option value="<?php echo $row_category['category_id']; ?>"><?php echo $row_category['category_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    <option value="category.php">--Add New Category--</option>
                                                </select>
                                                <div class="field-placeholder">Category</div>

                                            </div>
                                            <!-- Field wrapper end -->

                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                            <div class="field-wrapper">
                                                <div class="input-group">
                                                    <select name="quality_name" id="quality_name" onchange="if(this.value=='quality.php') getQuality()">
                                                        <option value="" selected>--Select--</option>
                                                        <?php
                                                        $sql_quality = "SELECT * FROM tbl_quality";
                                                        $rs_quality =  mysqli_query($con, $sql_quality);
                                                        if (!$rs_quality) 
                                                        {
                                                            die('No Quality Found.' . mysqli_error($con));
                                                        }
                                                        while ($row_quality = mysqli_fetch_array($rs_quality)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $row_quality['quality_id']; ?>"><?php echo $row_quality['quality_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <option value="quality.php">--Add New Quality--</option>
                                                    </select>
                                                </div>
                                                <div class="field-placeholder">Quality</div>
                                            </div>

                                        </div>

                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="field-wrapper">
                                                <input type="number" class="form-control" name="quantity" id="quantity">
                                                <div class="field-placeholder">Quantity </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <input type="text" class="form-control" name="item_name" id="item_name">
                                                <div class="field-placeholder">Item Name</div>
                                            </div>
                                            <!-- Field wrapper end -->
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" id="passDiv">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <input type="number" class="form-control" name="amount" id="amount" placeholder="0.00">

                                                <div class="field-placeholder">Amount</div>
                                            </div>
                                            <!-- Field wrapper end -->
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <div class="field-wrapper">
                                                <input type="number" class="form-control" name="op_stock" id="op_stock">
                                                <div class="field-placeholder">OP Stock </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="SizeDiv">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <div class="input-group">
                                                    <select class="select-multiple js-states" title="Select Product Category" multiple="multiple" name="size_name[]" id="size_name" onchange="if(this.value=='size.php') getSize()" data-select2-id="select2-data-size_name" tabindex="-1" aria-hidden="true">
                                                        <?php
                                                        $sql_size = "SELECT * FROM tbl_size";
                                                        $rs_size = mysqli_query($con, $sql_size);
                                                        if (!$rs_size) {
                                                            die('No Size Found.' . mysqli_error($con));
                                                        }
                                                        while ($row_size = mysqli_fetch_array($rs_size)) 
                                                        {
                                                            if ($row['size_id'] == $row_size['size_id']) 
                                                            {
                                                        ?>

                                                                <option value="<?php echo $row_size['size_id']; ?>" selected="selected"><?php echo $row_size['size_name']; ?></option>
                                                            <?php
                                                            } else { ?>
                                                                <option value="<?php echo $row_size['size_id']; ?>"><?php echo $row_size['size_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <option value="size.php">--Add New Size--</option>
                                                    </select>
                                                </div>
                                                <div id="selected_sizes"></div>
                                                <div class="field-placeholder">Size</div>
                                            </div>
                                            <!-- Field wrapper end -->
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="GsmDiv">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <div class="input-group">
                                                    <select class="select-multiple js-states" multiple="multiple" name="gsm_name[]" id="gsm_name" onchange="if(this.value=='gsm.php') getGsm()">
                                                        <!-- <option value="" selected>--Select--</option> -->
                                                        <?php
                                                        $sql_gsm = "SELECT * FROM tbl_gsm";
                                                        $rs_gsm = mysqli_query($con, $sql_gsm);
                                                        if (!$rs_gsm) 
                                                        {
                                                            die('No GSM Found.' . mysqli_error($con));
                                                        }
                                                        while ($row_gsm = mysqli_fetch_array($rs_gsm)) 
                                                        {
                                                        ?>
                                                            $gsm = explode(",",$row_gsm['gsm_name'])
                                                            <option value="<?php echo $row_gsm['gsm_id']; ?>"><?php echo $row_gsm['gsm_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        <option value="gsm.php">--Add Gsm--</option>
                                                    </select>


                                                </div>
                                                <div class="field-placeholder">GSM </div>
                                            </div>
                                            <!-- Field wrapper end -->
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="field-wrapper">
                                                <div class="input-group">
                                                    <select class=""  data-live-search="true" name="gst_name" id="gst_name">
                                                        <option value=""selected>Select</option>
                                                        <?php
                                                                $sql_gst_slab = "SELECT * FROM tbl_gst_slab";
                                                                $rs_gst_slab = mysqli_query($con,$sql_gst_slab);
                                                                if(!$rs_gst_slab)
                                                                {
                                                                    die('No Record Found.'.mysqli_error($con));
                                                                }
                                                                while($row_gst = mysqli_fetch_array($rs_gst_slab))
                                                                {
                                                        ?>
                                                        <option value="<?php echo $row_gst['gst_slab_id']; ?>"><?php echo $row_gst['gst_slab_name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="field-placeholder">GST </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="form-check" style="margin: 18px;">
                                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Is Active
                                                </label>
                                            </div>
                                            <!-- Field wrapper end -->
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                    <div class="vertical"></div>
                                    <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                        <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                            <input type="file" id="upload-item-default" name="item_photo" style="display:none;" onchange="saveImage(this)" />
                                            <input type="hidden" id="upload-item-photo-temp-default" value="" />
                                            <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-item-default-preview" for="upload-item-default">Upload Item Photo</label></div>
                                        </div>

                                        <div style="text-align:center;padding-top:10px;">
                                            <button class="btn btn-outline-primary" onclick="clearItemPhotoDefault()">ClearImage</button>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                    <input type="hidden" name="item_id" id="item_id">
                                    <input type="hidden" name="upload_item_photo" id="upload_item_photo">
                                    <button type="submit" name="btn_item" id="btn_item" class="btn btn-primary" onclick="return validate()">Save Item</button>
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
                            <div class="form-section-header">Item Data </div>
                        </div>

                        <div class="table-responsive">
                            <table id="copy-print-csv" class="table v-middle">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>Category Type</th>
                                        <th>Quality</th>
                                        <th>Size</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>GSM</th>
                                        <th>Amount</th>
                                        <th>OP Stock</th>
                                        <th>GST</th>
                                        <th>Active Status</th>
                                        <th>Added Date</th>
                                        <th>Photo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_view = "SELECT ti.*, 
                                    tq.quality_name, 
                                    tc.category_name, 
                                    ts.size_name, 
                                    tg.gsm_name,
                                    gsm_values.gsm_values,
                                    size_values.size_values,
                                    gst.gst_slab_name
                             FROM tbl_item ti
                             LEFT JOIN tbl_quality tq ON ti.quality_id = tq.quality_id
                             LEFT JOIN tbl_category tc ON ti.category_id = tc.category_id
                             LEFT JOIN tbl_size ts ON ti.size_id = ts.size_id
                             LEFT JOIN tbl_gsm tg ON ti.gsm_id = tg.gsm_id
                             LEFT JOIN tbl_gst_slab gst ON ti.gst_slab_id = gst.gst_slab_id
                             LEFT JOIN 
                             (
                                 SELECT ti.item_id, GROUP_CONCAT(tg.gsm_name) as gsm_values
                                 FROM tbl_item ti
                                 INNER JOIN tbl_gsm tg ON FIND_IN_SET(tg.gsm_id, ti.gsm_id)
                                 GROUP BY ti.item_id
                             ) AS gsm_values ON ti.item_id = gsm_values.item_id
                            LEFT JOIN 
                             (
                                 SELECT ti.item_id, GROUP_CONCAT(ts.size_name) as size_values
                                 FROM tbl_item ti
                                 INNER JOIN tbl_size ts ON FIND_IN_SET(ts.size_id, ti.size_id)
                                 GROUP BY ti.item_id
                             ) AS size_values ON ti.item_id = size_values.item_id; ";
                                    $rs_view = mysqli_query($con, $sql_view);

                                    if (!$rs_view) {
                                        die('View Not Found.' . mysqli_error($con));
                                    }

                                    while ($row_view = mysqli_fetch_array($rs_view)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="actions">
                                                    <a href="#" id="<?php echo $row_view['item_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="icon-edit1 text-info"></i>
                                                    </a>
                                                    <a href="#" id="<?php echo $row_view['item_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                        <i class="icon-x-circle text-danger"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><?php echo $row_view['category_name']; ?></td>
                                            <td><?php echo $row_view['quality_name']; ?></td>
                                            <td><?php echo $row_view['size_values']; ?></td>
                                            <td><?php echo $row_view['item_name']; ?></td>
                                            <td><?php echo $row_view['quantity']; ?></td>
                                            <td><?php echo $row_view['gsm_values']; ?></td>
                                            <td><?php echo $row_view['amount']; ?></td>
                                            <td><?php echo $row_view['op_stock']; ?></td>
                                            <td><?php echo $row_view['gst_slab_name']; ?></td>
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
                                            <td><?php echo date("d-m-Y", strtotime($row_view['added_date'])); ?></td>
                                            <td><img src="../images/item/<?php if ($row_view['item_photo'] == "") {
                                                                                echo 'noproof.jpg';
                                                                            } else {
                                                                                echo $row_view['item_photo'];
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
        $(document).ready(function() 
        {
            $('.btn_delete').click(function(e) 
            {
                e.preventDefault();
                var item_id = $(this).attr("id");

                //  alert(item_id);

                if (confirm("Are you Sure you Want to Delete this?")) 
                {
                    $.ajax({
                        url: 'item_delete.php',
                        data: {
                            'id': item_id,
                            'delete': 1
                        },
                        type: 'post',
                        success: function(output) 
                        {
                            window.location.reload();
                        }
                    });
                } 
                    else 
                {
                    return false;
                }
            });

            $('.btn_edit').click(function(e) 
            {
                e.preventDefault();
                var item_id = $(this).attr("id");

                //  alert(item_id);

                if (confirm("Are you Sure Want to Edit this?")) 
                {
                    $.ajax({
                        url: 'item_fetch.php',
                        data: {
                            'id': item_id,
                            'edit': 1
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(data) 
                        {
                            console.log(data);


                            document.getElementById("item_id").value = item_id;
                            document.getElementById("item_name").value = data.item_name;
                            document.getElementById("quality_name").value = data.quality_id;
                            document.getElementById("category_name").value = data.category_id;
                            document.getElementById("size_name").value = data.size_id;
                            document.getElementById("gsm_name").value = data.gsm_id;
                            document.getElementById("gst_name").value = data.gst_slab_id;
                            document.getElementById("quantity").value = data.quantity;
                            document.getElementById("amount").value = data.amount;
                            document.getElementById("op_stock").value = data.op_stock;
                            document.getElementById("upload-item-photo-temp-default").value = data.item_photo;
                            document.getElementById("upload_item_photo").value = data.item_photo;

                            if (data.is_active == 1) 
                            {
                                $('#is_active').prop('checked', true);
                            } 
                                else 
                            {
                                $('#is_active').prop('checked', false);
                            }


                            $("#upload-item-photo-temp-default").val(data.item_photo);
                            var imgStr = "<img src='" + '../images/item/' + data.item_photo + "' style='height:200px;width:200px;margin-top:-54px;'>";
                            $("#upload-item-default-preview").html(imgStr);
                            $("#upload-item-default-preview").css('color', 'initial');
                        },
                        error: function(data) 
                        {
                            console.log('my ERROR' + data.d);
                        }
                    });
                } 
                    else 
                {
                    return false;
                }
            });
        });

        function validate() 
        {
            var item_name = document.getElementById("item_name").value;
            var item_name_in = /^[A-Za-z ]+$/;

            var category_name = document.getElementById("category_name").value;

            var quality_name = document.getElementById("quality_name").value;

            var size_name = document.getElementById("size_name").value;

            var quantity = document.getElementById("quantity").value;

            var gsm_name = document.getElementById("gsm_name").value;

            var amount = document.getElementById("amount").value;

            var op_stock = document.getElementById("op_stock").value;

            if (category_name == "") 
            {
                alert("Please Select Category ");
                return false;
            }
            if (quality_name == "") 
            {
                alert("Please Select Quality ");
                return false;
            }
            if (size_name == "") 
            {
                alert("Please Select Size ");
                return false;
            }

            if (item_name == "") 
            {
                alert("Please Enter Item Name ");
                return false;
            }
            if (!item_name.match(item_name_in)) 
            {
                alert("Invalid Item Name.");
                return false;
            }
            if (quantity == "") 
            {
                alert("Please Enter Quantity ");
                return false;
            }
            if (gsm_name == "") 
            {
                alert("Please Select GSM ");
                return false;
            }
            if (amount == "") 
            {
                alert("Please Enter Amount ");
                return false;
            }
            if (op_stock == "") 
            {
                alert("Please Enter OP Stock ");
                return false;
            }
            return true;
        }
    </script>
    <?php
    include_once('footer.php');
    ?>
    <script>
        function saveImage(input) 
        {
            var previewStr = "#" + input.id + "-preview";
            if (input.files && input.files[0]) 
            {
                var fildr = new FileReader();
                fildr.onload = function(e) 
                {
                    var imgStr = "<img src='" + e.target.result + "' style='height:200px;width:200px;margin-top:-54px;'>";
                    $(previewStr).html(imgStr);
                    $(previewStr).css('color', 'initial');
                }
                fildr.readAsDataURL(input.files[0]);
                return true;
            } 
                else 
            {
                var message = "";
                if (input.id == "upload-image" || input.id == "upload-image-default") 
                {
                    message = "Expense Photo Is Needed.";
                } 
                    else 
                {
                    message = "Expense Photo Is Needed.";
                }
                $(previewStr).html(message);
                $(previewStr).css('color', 'red');
                return false;
            }
        }

        function clearItemPhotoDefault() 
        {
            $("#upload-item-photo-default-preview").html("Upload Item Photo.");
            $("#upload-item-photo-default").val("");
        }

        function getCategory() 
        {
            window.location.href = 'category.php';
        }

        function getQuality() 
        {
            window.location.href = 'quality.php';
        }


        function getSize() 
        {
            window.location.href = 'size.php';
        }

        function getGsm() 
        {
            window.location.href = 'gsm.php';
        }
    </script>