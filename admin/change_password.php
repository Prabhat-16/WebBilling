<?php
include_once('header.php');

if (isset($_POST['btn_pass'])) 
{
    $newPassword = $_POST['new_password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $sql = "UPDATE tbl_user SET password = '" . $hashedPassword . "'
    WHERE user_id ='" . $row_user_data['user_id'] . "'";
    $rs = mysqli_query($con, $sql);
    if (!$rs) 
    {
        die('Password Not Updated.' . mysqli_error($con));
    } 
        else 
    {
        echo "<script>alert('Password Changed Successfully');</script>";
        echo "<script>window.location = 'change_password.php';</script>";
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
                        <div class="form-section-header">Change Password</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="frm_password" id="frm_password" onsubmit="return validatePassword()">

                        <!-- Row start -->
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="text" name="new_password" id="new_password" required>
                                    <div class="field-placeholder">New Password</div>
                                    <div id="passwordHelpBlock" class="form-text">
                                        Your password must be 8-12 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <!-- Field wrapper end -->

                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                <!-- Field wrapper start -->
                                <div class="field-wrapper">
                                    <input class="form-control" type="password" name="cfrm_password" id="cfrm_password">
                                    <div class="field-placeholder">Confirm New Password</div>

                                </div>
                                <!-- Field wrapper end -->

                            </div>




                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                                <button type="submit" class="btn btn-primary" name="btn_pass" id="btn_pass">Change Password</button>
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

</div>
<!-- Content wrapper end -->
<script>
    function validatePassword()
    {
        var newPassword = document.getElementById("new_password").value;
        var confirmNewPassword = document.getElementById("cfrm_password").value;

        if(newPassword ==="" || confirmNewPassword === "")
        {
            alert("Please Fill in Both Password Fields.");

            return false;
        }

        if(newPassword !==  confirmNewPassword)
        {
            alert("New password and confirm password do not match.");
            return false;
        }
        return true;
    }
</script>

<?php
include_once('footer.php');


?>