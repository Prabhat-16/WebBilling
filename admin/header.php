<?php
require_once('../connection.php');
session_start();
if (!isset($_SESSION['user_id'])) {
	echo "<script>window.location = 'index.php';</script>";
} else {
	$user_data = "SELECT * FROM tbl_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
	$rs_user_data = mysqli_query($con, $user_data);
	if (!$rs_user_data) {
		die('No User Data Found.' . mysqli_error($con));
	}
	$row_user_data = mysqli_fetch_array($rs_user_data);
}
?>



<html lang="en">


<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Meta -->
	<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
	<meta name="author" content="ParkerThemes">
	<link rel="shortcut icon" href="img/fav.png">

	<!-- Title -->
	<title>Web Billing Admin</title>


	<!-- *************
			************ Common Css Files *************
		************ -->
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	

	<!-- Icomoon Font Icons css -->
	<link rel="stylesheet" href="fonts/style.css">

	<!-- Main css -->
	<link rel="stylesheet" href="css/main.css">


	<!-- *************
			************ Vendor Css Files *************
		************ -->

	<!-- Mega Menu -->
	<link rel="stylesheet" href="vendor/megamenu/css/megamenu.css">

	<!-- Notify -->
	<link rel="stylesheet" href="vendor/notify/notify-flat.css" />

	<!-- Bootstrap Select CSS -->
	<link rel="stylesheet" href="vendor/bs-select/bs-select.css" />




	<!-- Search Filter JS -->
	<link rel="stylesheet" href="vendor/search-filter/search-filter.css">
	<link rel="stylesheet" href="vendor/search-filter/custom-search-filter.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="vendor/datatables/dataTables.bs4.css" />
	<link rel="stylesheet" href="vendor/datatables/dataTables.bs4-custom.css" />
	<link rel="stylesheet" href="vendor/datatables/buttons.bs.css" />

	<!-- Date Range CSS -->
	<link rel="stylesheet" href="vendor/daterange/daterange.css">

	<!-- Uploader CSS -->
	<link rel="stylesheet" href="vendor/dropzone/dropzone.min.css" />






</head>

<body>
<!-- Other JavaScript files -->

	<!-- Loading wrapper start -->
	<!-- <div id="loading-wrapper">
		<div class="spinner-border"></div>
		Loading...
	</div> -->
	<!-- Loading wrapper end -->

	<!-- Page wrapper start -->
	<div class="page-wrapper">

		<!-- Sidebar wrapper start -->
		<nav class="sidebar-wrapper">

			<!-- Sidebar content start -->
			<div class="sidebar-tabs">

				<!-- Tabs nav start -->
				<div class="nav" role="tablist" aria-orientation="vertical">
					<a href="dashboard.php" class="logo">
						<img src="img/logo.svg" alt="Uni Pro Admin">
					</a>
					<a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab" aria-controls="tab-home" aria-selected="true">
						<i class="icon-home2"></i>
						<span class="nav-link-text">Dashboards</span>
					</a>
					<a class="nav-link" id="product-tab" data-bs-toggle="tab" href="#tab-product" role="tab" aria-controls="tab-product" aria-selected="false">
						<i class="icon-layers2"></i>
						<span class="nav-link-text">Product</span>
					</a>
					<a class="nav-link" id="pages-tab" data-bs-toggle="tab" href="#tab-pages" role="tab" aria-controls="tab-pages" aria-selected="false">
						<i class="icon-people_outline"></i>
						<span class="nav-link-text">Client</span>
					</a>
					<a class="nav-link" id="forms-tab" data-bs-toggle="tab" href="#tab-forms" role="tab" aria-controls="tab-forms" aria-selected="false">
						<i class="icon-edit1"></i>
						<span class="nav-link-text">Accounting</span>
					</a>
					<a class="nav-link" id="components-tab" data-bs-toggle="tab" href="#tab-components" role="tab" aria-controls="tab-components" aria-selected="false">
						<i class="icon-file"></i>
						<span class="nav-link-text">Reports</span>
					</a>
					<a class="nav-link" id="graphs-tab" data-bs-toggle="tab" href="#tab-graphs" role="tab" aria-controls="tab-graphs" aria-selected="false">
						<i class="icon-file-text"></i>
						<span class="nav-link-text">Invoice</span>
					</a>
					<a class="nav-link" id="authentication-tab" data-bs-toggle="tab" href="#tab-authentication" role="tab" aria-controls="tab-authentication" aria-selected="false">
						<i class="icon-unlock"></i>
						<span class="nav-link-text">Authentication</span>
					</a>
					<a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-authentication" aria-selected="false">
						<i class="icon-settings1"></i>
						<span class="nav-link-text">Settings</span>
					</a>

				</div>
				<!-- Tabs nav end -->

				<!-- Tabs content start -->
				<div class="tab-content">

					<!-- Chat tab -->
					<div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="home-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Dashboards
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="dashboard.php" class="current-page">Dashboard</a>
									</li>

							</div>
						</div>
						<!-- Sidebar menu ends -->



					</div>

					<!-- Pages tab -->
					<div class="tab-pane fade" id="tab-product" role="tabpanel" aria-labelledby="product-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Product
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="item.php">Item Master</a>
									</li>
									<li>
										<a href="category.php">Category Master</a>
									</li>
									<li>
										<a href="quality.php">Quality Master</a>
									</li>
									<li>
										<a href="size.php">Size Master</a>
									</li>
									<li>
										<a href="gst_slab.php">GST Slab Master</a>
									</li>
									<li>
										<a href="gsm.php">GSM Master</a>
									</li>

								</ul>

							</div>
						</div>
					</div>

					<!-- Pages tab -->
					<div class="tab-pane fade" id="tab-pages" role="tabpanel" aria-labelledby="pages-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Client
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="party.php">Party Master</a>
									</li>
									<li>
										<a href="driver.php">Driver Master</a>
									</li>
									<li>
										<a href="transport.php">Transport Master</a>
									</li>

								</ul>
							</div>
						</div>
						<!-- Sidebar menu ends -->


					</div>

					<!-- Forms tab -->
					<div class="tab-pane fade" id="tab-forms" role="tabpanel" aria-labelledby="forms-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Accounting
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="expense.php">Expense Master</a>
									</li>
									<li>
										<a href="income.php">Income Master</a>
									</li>
									<li>
										<a href="party_ledger.php">Party Ledger</a>
									</li>


								</ul>

							</div>
						</div>
						<!-- Sidebar menu ends -->



					</div>

					<!-- Components tab -->
					<div class="tab-pane fade" id="tab-components" role="tabpanel" aria-labelledby="components-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Report's
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="expense_report.php">Expense Report </a>
									</li>
									<li>
										<a href="income_report.php">Income Report</a>
									</li>
									<li>
										<a href="cash_memo_report.php">Cash Memo Report</a>
									</li>
									<li>
										<a href="purchase_invoice_report.php">Purchase Invoice Report</a>
									</li>
									<li>
										<a href="sales_invoice_report.php">Sales Invoice Report</a>
									</li>

								</ul>
							</div>
						</div>
						<!-- Sidebar menu ends -->



					</div>

					<!-- Graphs tab -->
					<div class="tab-pane fade" id="tab-graphs" role="tabpanel" aria-labelledby="graphs-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Invoice's
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								
								<ul>
									<!-- <li class="list-heading">Graphs</li> -->
									<li>
										<a href="view_purchase_invoice.php">Purchase Invoice</a>
									</li>
									<li>
										<a href="view_sales_invoice.php">Sales Invoice</a>
									</li>
									<li>
										<a href="view_cash_memo_invoice.php">Cash Memo Invoice</a>
									</li>
									<li>
										<a href="cash_memo_return_invoice.php">Cash Memo Return Invoice</a>
									</li>

								</ul>


							</div>
						</div>


					</div>

					<!-- Authentication tab -->
					<div class="tab-pane fade" id="tab-authentication" role="tabpanel" aria-labelledby="authentication-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Authentication
						</div>
						<!-- Tab content header end -->

						<!-- Sidebar menu starts -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="company.php">Company Master</a>
									</li>
									<li>
										<a href="user.php">User Master</a>
									</li>
									<li>
										<a href="change_password.php">Change Password</a>
									</li>

								</ul>
							</div>
						</div>
						<!-- Sidebar menu ends -->



					</div>

					<!-- Settings tab -->
					<div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="settings-tab">

						<!-- Tab content header start -->
						<div class="tab-pane-header">
							Types
						</div>
						<!-- Tab content header end -->
						<div class="sidebarMenuScroll">
							<div class="sidebar-menu">
								<ul>
									<li>
										<a href="payment_type.php">Payment Type</a>
									</li>
									<li>
										<a href="expense_type.php">Expense Type</a>
									</li>
									<li>
										<a href="income_type.php">Income Type</a>
									</li>
									<li>
										<a href="financial_year.php">Financial Year Type</a>
									</li>

								</ul>

							</div>

						</div>

						<!-- Settings start -->
						<!-- <div class="sidebarMenuScroll">
								<div class="sidebar-settings">
									<div class="accordion" id="settingsAccordion">
										<ul>
										<li>
											<a href="payment.php">payment</a>
										</li>
										</ul>


									</div>
								</div>
							</div> -->
						<!-- Settings end -->

						<!-- Sidebar actions starts -->
						<div class="sidebar-actions">

						</div>
						<!-- Sidebar actions ends -->
					</div>


				</div>
				<!-- Tabs content end -->

			</div>
			<!-- Sidebar content end -->

		</nav>
		<!-- Sidebar wrapper end -->

		<!-- *************
				************ Main container start *************
			************* -->
		<div class="main-container">

			<!-- Page header starts -->
			<div class="page-header">

				<!-- Row start -->
				<div class="row gutters">
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-9">

						<!-- Search container start -->
						<div class="search-container">

							<!-- Toggle sidebar start -->
							<div class="toggle-sidebar" id="toggle-sidebar">
								<i class="icon-menu"></i>
							</div>
							<!-- Toggle sidebar end -->

						</div>
						<!-- Search container end -->

					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-3">

						<!-- Header actions start -->
						<ul class="header-actions">

							<li class="dropdown">
								<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
									<span class="avatar">
										<img src="img/user.svg" alt="User Avatar">
										<span class="status busy"></span>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-end md" aria-labelledby="userSettings">
									<div class="header-profile-actions">
										<a href="profile.php"><i class="icon-user1"></i>Profile</a>
										<a href="logout.php"><i class="icon-log-out1"></i>Logout</a>
									</div>
								</div>
							</li>
						</ul>
						<!-- Header actions end -->

					</div>
				</div>
				<!-- Row end -->

			</div>
			<!-- Page header ends -->