<?php
include_once('header.php');


// File upload folder 
$uploadDir = '../images/user/'; 





// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 



$user_profile = $row_user_data["user_profile"];

if(isset($_POST['btnUpdate']))
{
    $uploadedFile = ''; 
    if(!empty($_FILES["user_profile"]["name"]))
    { 
        // File path config 
        $fileName = basename($_FILES["user_profile"]["name"]); 
        $targetFilePath = $uploadDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
        // Allow certain file formats to upload 
        if(in_array($fileType, $allowTypes))
        { 
            // Upload file to the server 
            if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $targetFilePath))
            { 
                $uploadedFile = $fileName;
                        
                //delete user profile in folder
                if($user_profile != "")
                {
                    unlink($uploadDir.$user_profile);
                }
                
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
            $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
        } 
    } 
    else
    {
        $uploadedFile = $user_profile;
    }

    
    //SET AS DEFAULT CODE
    if(isset($_POST['is_active']))
    {
        $is_active = $_POST['is_active'];
    }
    else
    {
        $is_active = 0;
    }

    $sql_update = "UPDATE tbl_user SET full_name = '".$_POST['full_name']."' , email ='".$_POST['email']."', phone ='".$_POST['phone']."' , username = '".$_POST['username']."' , is_active = '".$is_active."' , user_profile = '".$uploadedFile."'
    WHERE user_id = '".$row_user_data['user_id']."'";
    $rs_update=mysqli_query($con,$sql_update);
    if(!$rs_update)
    {
        die("not updated" .mysqli_error($con));
    }
    else
    {
         echo "<script>window.location = 'profile.php';</script>";
    }


}

?>

<!-- Content wrapper start -->
<div class="content-wrapper">

    <!-- Row start -->
    <div class="row gutters">
       
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header-lg">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                    <div class="form-section-header">User Profile</div>
                </div>
                </div>

                <div class="card-body"> 
                    <form action="" method="post" name="frmupdate" id="frmupdate" enctype="multipart/form-data">


                        <div class="row gutters">


                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="vertical"></div>
                                <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                    <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                        <input type="file" id="upload-user-profile-default" name="user_profile" style="display:none;" onchange="saveImage(this)" />
                                        <input type="hidden" id="upload-user-profile-temp-default" value="" />
                                        <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-user-profile-default-preview" for="upload-user-profile-default"><img src="../images/user/<?php echo    $row_user_data['user_profile']; ?>"  style="width:200px; height:200px;"></label></div>

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
                                            <input type="text" class="form-control" name="full_name" id="full_name" require value="<?php echo $row_user_data['full_name']; ?>">
                                            <div class="field-placeholder">Full Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="email" class="form-control" name="email" id="email" require value="<?php echo $row_user_data['email']; ?>">
                                            <div class="field-placeholder">Email</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="number" class="form-control" name="phone" id="phone" require value="<?php echo $row_user_data['phone']; ?>">
                                            <div class="field-placeholder">Phone</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-6" style="margin-top: 20px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" <?php if($row_user_data['is_active'] == 1) { echo 'checked';} ?> >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                IS ACTIVE
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="text" class="form-control" name="username" id="username" require value="<?php echo $row_user_data['username']; ?>">
                                            <div class="field-placeholder">Username</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $row_user_data['user_id'];  ?>" />
                                <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-primary mb-3" >Update User</button>
                            </div>
                    </form>

                </div>

            </div>
        </div>
        <!-- Card end -->

    </div>
</div>
<!-- Row end -->

</div>
<!-- Content wrapper end -->

<?php
include_once('footer.php');

?>

<script>

	 function saveImage(input) 
	 {
            var previewStr = "#" + input.id + "-preview";
            if (input.files && input.files[0]) {
                var fildr = new FileReader();
                fildr.onload = function (e) {
                    var imgStr = "<img src='" + e.target.result + "' style='height:200px;width:200px;margin-top:-54px;'>";
                    $(previewStr).html(imgStr);
                    $(previewStr).css('color', 'initial');
                }
                fildr.readAsDataURL(input.files[0]);
                return true;
            }
            else {
                var message = "";
                if (input.id == "upload-image" || input.id == "upload-image-default") {
                    message = "User Profile Is Needed.";
                }
                else {
                    message = "User Profile Is Needed.";
                }
                $(previewStr).html(message);
                $(previewStr).css('color', 'red');
                return false;
            }
        }

	function clearUserProfileDefault() 
	{
		$("#upload-user-profile-default-preview").html("Upload User Profile.");
		$("#upload-user-logo-profile").val("");
	}


	
</script>



