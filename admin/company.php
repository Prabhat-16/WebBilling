<?php
include_once('header.php');


// File upload folder 
$uploadDir = '../images/company/'; 


// File upload folder 
$uploadDir1 = '../images/signature/'; 


// Allowed file types 
$allowTypes = array('jpg', 'png', 'jpeg'); 

$sql_view="CALL viewCompany()";
$rs_view=mysqli_query($con,$sql_view);
mysqli_next_result($con); // Advance to the next result set
$row_company=mysqli_fetch_array($rs_view);
$company_logo = $row_company["company_logo"];
$signature = $row_company["signature"];

if(isset($_POST['btnUpdate']))
{
    $uploadedFile = ''; 
    if(!empty($_FILES["company_logo"]["name"]))
    { 
        // File path config 
        $fileName = basename($_FILES["company_logo"]["name"]); 
        $targetFilePath = $uploadDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
        // Allow certain file formats to upload 
        if(in_array($fileType, $allowTypes))
        { 
            // Upload file to the server 
            if(move_uploaded_file($_FILES["company_logo"]["tmp_name"], $targetFilePath))
            { 
                $uploadedFile = $fileName;
                        
                //delete user profile in folder
                if($company_logo != "")
                {
                    unlink($uploadDir.$company_logo);
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
        $uploadedFile = $company_logo;
    }

    //Signature Code
    $uploadedFile1 = ''; 
    if(!empty($_FILES["signature"]["name"]))
    { 
        // File path config 
        $fileName = basename($_FILES["signature"]["name"]); 
        $targetFilePath = $uploadDir1 . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
        // Allow certain file formats to upload 
        if(in_array($fileType, $allowTypes))
        { 
            // Upload file to the server 
            if(move_uploaded_file($_FILES["signature"]["tmp_name"], $targetFilePath))
            { 
                $uploadedFile1 = $fileName;
                        
                //delete user profile in folder
                if($signature != "")
                {
                    unlink($uploadDir1.$signature);
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
        $uploadedFile1 = $signature;
    }

    




    //SET AS DEFAULT CODE
    if(isset($_POST['set_as_default']))
    {
        $set_as_default = $_POST['set_as_default'];
    }
    else
    {
        $set_as_default = 0;
    }

    $sql_update = "CALL updateCompany('".$_POST['company_id']."','".$_POST['company_name']."','".$_POST['email']."','".$_POST['phone']."','".$set_as_default."','".$_POST['alternate_phone']."','".$_POST['address']."','".$_POST['state']."','".$uploadedFile."','".$uploadedFile1."')";

    

    $rs_update=mysqli_query($con,$sql_update);
    if(!$rs_update)
    {
        die("not updated" .mysqli_error($con));
    }
    else
    {
         echo "<script>window.location = 'company.php';</script>";
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
                    <div class="form-section-header">Company Master</div>
                </div>
                </div>

                <div class="card-body"> 
                    <form action="" method="post" name="frmupdate" id="frmupdate" enctype="multipart/form-data">


                        <div class="row gutters">


                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="vertical"></div>
                                <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                    <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                        <input type="file" id="upload-company-logo-default" name="company_logo" style="display:none;" onchange="saveImage(this)" />
                                        <input type="hidden" id="upload-company-logo-temp-default" value="" />
                                        <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-company-logo-default-preview" for="upload-company-logo-default"><img src="../images/company/<?php echo    $row_company['company_logo']; ?>"  style="width:200px; height:200px;"></label></div>

                                    </div>

                                    <div style="text-align:center;padding-top:10px;">
                                        <button class="btn btn-outline-primary" onclick="clearCompanyLogoDefault()">Clear Company Logo</button>
                                    </div>

                                </div>
                                <div id="dropzone-sm" class="mb-3 image-upload-clear-image">
                                    <div class="dropzone needsclick dz-clickable" id="demo-upload">
                                        <input type="file" id="upload-signature-default" name="signature" style="display:none;" onchange="saveImage1(this)" />
                                        <input type="hidden" id="upload-signature-temp-default" value="" />
                                        <div class="dz-message needsclick" style="text-align: center; margin-top: 54px;"><label id="upload-signature-default-preview" for="upload-signature-default"><img src="../images/signature/<?php echo $row_company['signature']; ?>"  style='height:200px;width:200px;margin-top:-54px;'></label></div>

                                    </div>

                                    <div style="text-align:center;padding-top:10px;">
                                        <button class="btn btn-outline-primary" onclick="clearSignatureDefault()">Clear signature</button>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="text" class="form-control" name="company_name" id="company_name" require value="<?php echo $row_company['company_name']; ?>">
                                            <div class="field-placeholder">company Name</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="email" class="form-control" name="email" id="email" require value="<?php echo $row_company['email']; ?>">
                                            <div class="field-placeholder">Email</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="number" class="form-control" name="phone" id="phone" require value="<?php echo $row_company['phone']; ?>">
                                            <div class="field-placeholder">Phone</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-6" style="margin-top: 20px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="set_as_default" name="set_as_default" <?php if($row_company['set_as_default'] == 1) { echo 'checked';} ?> >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                SET AS DEFAULT
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="number" class="form-control" name="alternate_phone" id="alternate_phone" require value="<?php echo $row_company['alternate_phone']; ?>">
                                            <div class="field-placeholder">Alternate phone</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <select name="state" id="state">
                                                <option value="" selected>Select State</option>
                                                <option value="Gujarat"<?php if($row_company['state'] == 'Gujarat'){echo "selected";} ?>>Gujarat</option>
                                            </select>
                                            <div class="field-placeholder">State</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <!-- Field wrapper start -->
                                        <div class="field-wrapper">
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $row_company['address']; ?>">
                                            <div class="field-placeholder">Address</div>
                                        </div>
                                        <!-- Field wrapper end -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="text-align: right;">
                            <input type="hidden" name="company_id" id="company_id" value="<?php echo $row_company['company_id'];  ?>" />
                                <button type="submit" name="btnUpdate" id="btnUpdate" class="btn btn-primary mb-3" onclick="return validate" >Update Company</button>
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

    <script>
        function validate()
        {
        var company_name = document.getElementById("company_name").value;
        var company_name_in = /^[A-Za-z ]+$/;

        var email = document.getElementById("email").value;
        var email_in =  /\S+@\S+\.\S+/;

        var phone = document.getElementById("phone").value; 
        var phone_in = /^\d{10}$/;


        var state = document.getElementById("state").value;

        var address = document.getElementById("address").value;

        if(company_name == "")
        {
            alert("Please Enter Company Name ");
            return false;
        }
        if(!company_name.match(company_name_in))
        {
            alert("Invalid Company Name.");
            return false;
        }

        if(email == "")
        {
            alert("Please  Enter email.");
            return false;
        }        
        
        if(!email.match(email_in))
        {
            alert("Invalid email.");
            return false;
        }

        if(phone == "")
        {
            alert("Please Enter Contact No");
            return false;
        }
        if(!phone.match(phone_in))
        {
            alert("Invalid Phone number Must Be 10 Digits.");
            return false;
        }

       
        if(state == "")
        {
            alert("Please Select State.");
            return false;
        }    

        if(address == "")
        {
            alert("Please Enter address ");
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
                    message = "Company Logo Is Needed.";
                }
                else {
                    message = "Company Logo Is Needed.";
                }
                $(previewStr).html(message);
                $(previewStr).css('color', 'red');
                return false;
            }
        }

	function clearCompanyLogoDefault() 
	{
		$("#upload-company-logo-default-preview").html("Upload Company Logo.");
		$("#upload-company-logo-default").val("");
	}


	function saveImage1(input) 
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
                    message = "Signature Is Needed.";
                }
                else {
                    message = "Signature Is Needed.";
                }
                $(previewStr).html(message);
                $(previewStr).css('color', 'red');
                return false;
            }
        }

	function clearSignatureDefault() 
	{
		$("#upload-signature-default-preview").html("Upload Signature.");
		$("#upload-signature-default").val("");
	}
</script>