<?php session_start();
if(isset($_SESSION['logged']['status'])){
    header("location: dashboard.php");
    exit();
}  
include 'connection/connect.php';
include 'includes/login_process.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>Project One</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">	
</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded30 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Let's Get Started</h2>
								<p class="mb-0 text-warning"></p>							
							</div>
							<div class="p-40">
								<form id="login_form" name="login_form" method="post">
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											</div>
											<input type="text" class="form-control pl-15 bg-transparent" id="username" name="username" placeholder="Username">
											
												<?php if (isset($_SESSION['error_message']['username_empty']) && !empty($_SESSION['error_message']['username_empty'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['username_empty']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['username_empty']);
												}
												?>
												<?php if (isset($_SESSION['error_message']['username_valid']) && !empty($_SESSION['error_message']['username_valid'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['username_valid']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['username_valid']);
												}
												?>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											</div>
											<input type="password" class="form-control pl-15 bg-transparent" id="password" name="password" placeholder="Password">
											<?php if (isset($_SESSION['error_message']['password_empty']) && !empty($_SESSION['error_message']['password_empty'])) { ?>
													<div class="alert alert-warning">
														<strong>Warning!</strong> <?php echo $_SESSION['error_message']['password_empty']; ?>
													</div>
													<?php
													unset($_SESSION['error_message']['password_empty']);
												}
												?>
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Remember Me</label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-6">
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <input type="submit" name="login_submit" value="Sign In" class="btn btn-danger mt-10" />
										</div>
										<!-- /.col -->
									  </div>
								</form>		
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="js/vendors.min.js"></script>
	<script src="js/pages/chat-popup.js"></script>
    <script src="assets/icons/feather-icons/feather.min.js"></script>	

</body>
</html>
