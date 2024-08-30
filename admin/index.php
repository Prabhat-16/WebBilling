<?php
include_once('../connection.php');

if (isset($_POST['btn_login'])) 
{
    $username = $_POST['txt_user'];
    $password = $_POST['pass_password'];

    $sql_login = "SELECT * FROM tbl_user WHERE (email = '".$username."' OR phone = '".$username."' OR username = '".$username."')";
    $rs = mysqli_query($con, $sql_login);

    if ($rs && mysqli_num_rows($rs) > 0) 
    {
        $row = mysqli_fetch_assoc($rs);
		
        
        // Verify the password
        if (password_verify($password, $row['password'])) 
        {
            // Password is correct, start session
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            echo "<script>window.location = 'dashboard.php';</script>";
        } 
        else 
        {
            echo '<script>alert("Invalid Password.")</script>'; 
        }
    } 
    else 
    {
        echo '<script>alert("Invalid Username Or Password.")</script>'; 
    }
}

?>


<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta -->
	<meta name="description" content="UniPro App">
	<meta name="author" content="ParkerThemes">
	<link rel="shortcut icon" href="img/fav.png" />

	<!-- Title -->
	<title>User Login</title>


	<!-- *************
			************ Common Css Files *************
		************ -->
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">


	<!-- *************
			************ Vendor Css Files *************
		************ -->

</head>

<body class="authentication">

	<!-- Loading wrapper start -->
	<!-- <div id="loading-wrapper">
		<div class="spinner-border"></div>
		Loading...
	</div> -->
	<!-- Loading wrapper end -->

	<!-- *************
			************ Login container start *************
		************* -->
	<div class="login-container">

		<div class="container-fluid h-100">

			<!-- Row start -->
			<div class="row g-0 h-100">

				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
					<div class="login-wrapper">
						<form action="" method="post" name="frm_login" id="frm_login">
							<div class="login-screen">
								<div class="login-body">
									<a href="#" class="login-logo">
										<img src="img/logo.svg" alt="iChat">
									</a>
									<h6>Welcome back,<br>Please login to your account.</h6>
									<div class="field-wrapper">
										<input type="text" autofocus name="txt_user" id="txt_user">
										<div class="field-placeholder">Username</div>
									</div>
									<div class="field-wrapper mb-3">
										<input type="password" id="pass_password" name="pass_password">
										<div class="field-placeholder">Password</div>
									</div>
									<div class="actions">
										<a href="forgot-password.html">Forgot password?</a>
										<button type="submit" class="btn btn-primary" name="btn_login" id="btn_login">Login</button>
									</div>
								</div>
								
							</div>
						</form>
					</div>
				</div>
				
			</div>
			<!-- Row end -->

		</div>
	</div>
	<!-- *************
			************ Login container end *************
		************* -->

	<!-- *************
			************ Required JavaScript Files *************
		************* -->
	<!-- Required jQuery first, then Bootstrap Bundle JS -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/modernizr.js"></script>
	<script src="js/moment.js"></script>

	<!-- *************
			************ Vendor Js Files *************
		************* -->

	<!-- Main Js Required -->
	<script src="js/main.js"></script>

</body>

</html>