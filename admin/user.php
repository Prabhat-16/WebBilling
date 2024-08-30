<?php
include_once('header.php');
// $user_profile = $row_profile["user_profile"];
$uploadDir = '../images/user/';

// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg');

if (isset($_POST['btn_save'])) {
    try {
        $uploadedFile = '';
        // Check if a file is uploaded
        if (!empty($_FILES["user_profile"]["name"])) {
            $fileName = basename($_FILES["user_profile"]["name"]);
            $targetFilePath = $uploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Check if the file type is allowed
            if (in_array($fileType, $allowTypes)) {
                // Upload file to the server
                if (move_uploaded_file($_FILES["user_profile"]["tmp_name"], $targetFilePath)) {
                    $uploadedFile = $fileName;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
            }
        }
        // Check if it's an update or insert
        if (empty($_POST['user_id'])) 
        {
            // Insert operation
            $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "CALL insertUser('" . $_POST['full_name'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['username'] . "','" . $hashedPassword . "','" . $is_active . "','0','" . $uploadedFile . "' , '" . $_SESSION['user_id'] . "')";
        } else {
            // Update operation
            $is_active = isset($_POST['is_active']) ? $_POST['is_active'] : 0;
            $sql = "SELECT user_profile FROM tbl_user WHERE user_id = '" . $_POST['user_id'] . "'";
            $rs = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($rs);
            $existing_image = $row['user_profile'];

            // Check if a new image is uploaded
            if (!empty($_FILES["user_profile"]["name"])) {
                // New image is uploaded, update with the new image
                $fileName = basename($_FILES["user_profile"]["name"]);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Check if the file type is allowed
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to the server
                    if (move_uploaded_file($_FILES["user_profile"]["tmp_name"], $targetFilePath)) {
                        // Delete old image if it exists
                        if (!empty($existing_image)) {
                            $oldFilePath = $uploadDir . $existing_image;
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $uploadedFile = $fileName;
                    } else {
                        $uploadStatus = 0;
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                    }
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
                }
            } else 
            {
                // No new image uploaded, retain the existing image
                $uploadedFile = $existing_image;
            }


            $sql = "CALL updateUser('" . $_POST['user_id'] . "','" . $_POST['full_name'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['username'] . "','" . $is_active . "','" . $uploadedFile . "' , '" . $_SESSION['user_id'] . "')";
        }

        $rs = mysqli_query($con, $sql);

        if (!$rs) 
        {
            die('Record not Inserted/Updated.' . mysqli_error($con));
        }
        echo "<script>window.location = 'user.php';</script>";
    } catch (Exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('User  Already Exists')";
            echo "</script>";
            echo "<script>window.location = 'user.php';</script>";
        }
    }
}
?>
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header-lg">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">User Master</div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="" method="post" name="frm_user" id="frm_user" enctype="multipart/form-data">


                        <div class="row gutters">


                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="vertical"></div>
                                <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                    <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                        <input type="file" id="upload-user-profile-default" name="user_profile" style="display:none;" onchange="saveImage(this)" />
                                        <input type="hidden" id="upload-user-profile-temp-default" value="" />
                                        <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-user-profile-default-preview" for="upload-user-profile-default">Upload User Profile</label></div>

                                    </div>

                                    <div style="text-align:center;padding-top:10px;">
                                        <button class="btn btn-outline-primary" onclick="clearUserProfileDefault()">Clear User Profile</button>
                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="text" class="form-control" name="full_name" id="full_name">
                                            <div class="field-placeholder">Full Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="email" class="form-control" name="email" id="email">
                                            <div class="field-placeholder">Email</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="number" class="form-control" name="phone" id="phone">
                                            <div class="field-placeholder">Phone</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-6" style="margin-top: 20px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Is Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="text" maxlength="15" class="form-control" name="username" id="username">
                                            <div class="field-placeholder">Username</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="passDiv">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="password" maxlength="20" name="password" id="password">
                                            <div class="field-placeholder">Password</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                <input type="hidden" name="user_id" id="user_id">
                                <input type="hidden" id="upload_user_profile" id="upload_user_profile">
                                <button type="submit" class="btn btn-primary" name="btn_save" id="btn_save" onclick="return validate()">Submit</button>
                                <button type="reset" class="btn btn-light" name="btn_reset" id="btn_reset">Cancel</button>
                            </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- Card end -->

    </div>
    <!-- </div> -->

    <!-- Row end -->
    <!-- Content wrapper start -->

    <!-- Content wrapper end -->


    <!-- <div class="content-wrapper" style="width:100%;"> -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                        <div class="form-section-header">User's Data Table</div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table v-middle">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Profile</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Username</th>
                                    <th>Active Status</th>
                                    <th>Added Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql_view = "CALL viewUser()";
                                $rs_view = mysqli_query($con, $sql_view);
                                if (!$rs_view) {
                                    die('View Not Found.' . mysqli_error($con));
                                }
                                while ($row_view = mysqli_fetch_array($rs_view)) {
                                ?>
                                    <tr>

                                        <td>
                                            <div class="actions">
                                                <a href="#" id="<?php echo $row_view['user_id'] ?>" class="btn_edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="icon-edit1 text-info"></i>
                                                </a>
                                                <a href="#" id="<?php echo $row_view['user_id'] ?>" class="btn_delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                                    <i class="icon-x-circle text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><img src="../images/user/<?php if ($row_view['user_profile'] == "") {
                                                                            echo 'circled-user.png';
                                                                        } else {
                                                                            echo $row_view['user_profile'];
                                                                        } ?>" width="40px" height="40px"></td>
                                        <td><?php echo $row_view['full_name']; ?></td>
                                        <td><?php echo $row_view['email']; ?></td>
                                        <td><?php echo $row_view['phone']; ?></td>
                                        <td><?php echo $row_view['username']; ?></td>




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
<!-- Row start -->

<!-- Row end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var user_id = $(this).attr("id");

            // alert(user_id);

            if (confirm("Are you Sure you Want to Delete this?")) {
                $.ajax({
                    url: 'user_delete.php',
                    data: {
                        'id': user_id,
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
            var user_id = $(this).attr("id");

            // alert(user_id);

            if (confirm("Are you Sure Want to Edit this?")) {
                $.ajax({
                    url: 'user_fetch.php',
                    data: {
                        'id': user_id,
                        'edit': 1
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.user_id);
                        document.getElementById("user_id").value = user_id;
                        document.getElementById("full_name").value = data.full_name;
                        document.getElementById("email").value = data.email;
                        document.getElementById("phone").value = data.phone;
                        document.getElementById("username").value = data.username;
                        document.getElementById("passDiv").style.display = 'none';
                        document.getElementById("upload-user-profile-temp-default").value = data.user_profile;
                        document.getElementById("upload_user_profile").value = data.user_profile;


                        if (data.is_active == 1) {
                            $('#is_active').prop('checked', true);
                        } else {
                            $('#is_active').prop('checked', false);
                        }


                        $("#upload-user-profile-temp-default").val(data.user_profile);
                        var imgStr = "<img src='" + '../images/user/' + data.user_profile + "' style='height:200px;width:200px;margin-top:-54px;'>";
                        $("#upload-user-profile-default-preview").html(imgStr);
                        $("#upload-user-profile-default-preview").css('color', 'initial');


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
        var full_name = document.getElementById("full_name").value;
        var full_name_in = /^[A-Za-z ]+$/;

        var email = document.getElementById("email").value;
        var email_in = /\S+@\S+\.\S+/;

        var phone = document.getElementById("phone").value;
        var phone_in = /^\d{10}$/;

        var username = document.getElementById("username").value;

        // var password = document.getElementById("password").value;



        if (full_name == "") {
            alert("Please Enter Full Name ");
            return false;
        }
        if (!full_name.match(full_name_in)) {
            alert("Invalid Full Name.");
            return false;
        }

        if (email == "") {
            alert("Please  Enter email.");
            return false;
        }

        if (!email.match(email_in)) {
            alert("Invalid email.");
            return false;
        }

        if (phone == "") {
            alert("Please Enter Contact No");
            return false;
        }
        if (!phone.match(phone_in)) {
            alert("Invalid Phone number Must Be 10 Digits.");
            return false;
        }

        if (username == "") {
            alert("Please Enter Username.");
            return false;
        }

        if (password == "") {
            alert("Please Enter Password ");
            return false;
        }
        return true;
    }
</script>
<script>
    function saveImage(input) {
        var previewStr = "#" + input.id + "-preview";
        if (input.files && input.files[0]) {
            var fildr = new FileReader();
            fildr.onload = function(e) {
                var imgStr = "<img src='" + e.target.result + "' style='height:200px;width:200px;margin-top:-54px;'>";
                $(previewStr).html(imgStr);
                $(previewStr).css('color', 'initial');
            }
            fildr.readAsDataURL(input.files[0]);
            return true;
        } else {
            var message = "";
            if (input.id == "upload-image" || input.id == "upload-image-default") {
                message = "User Profile Is Needed.";
            } else {
                message = "User Profile Is Needed.";
            }
            $(previewStr).html(message);
            $(previewStr).css('color', 'red');
            return false;
        }
    }

    function clearUserProfileDefault() {
        $("#upload-user-profile-default-preview").html("Upload User Profile.");
        $("#upload-user-profile-default").val("");
    }
</script>
<?php
include_once('footer.php');
?>