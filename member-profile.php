<?php 
include('partial/header.php');
$code=$_GET['id'];
$sql = "select * FROM `members` WHERE `code`='$code'";				
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Member Profile</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Member Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			 <div class="col-12 col-lg-6 col-xl-6">
				 <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
					  <h3 class="widget-user-username"><?php echo $row['name'] ?></h3>
					  <h6 class="widget-user-desc">Member</h6>
					</div>
					<div class="widget-user-image">
					  <img class="" src="flats_photo/<?php echo $row['photo'] ?>" alt="User Avatar">
					</div>
					<div class="box-footer">
					  
					  <!-- /.row -->
					</div>
				  </div>
				  </div>
				  <div class="col-12 col-lg-6 col-xl-6">
				  <div class="box">
					<div class="box-body box-profile">            
					  <div class="row">
						<div class="col-12">
							<div>
								<p>Email	:<span class="text-gray pl-10"><?php echo $row['email'] ?></span> </p>
								<p>Phone	:<span class="text-gray pl-10"><?php echo $row['phone'] ?></span></p>
								<p>Address	:<span class="text-gray pl-10"><?php echo $row['address'] ?></span></p>
							</div>
						</div>
					  </div>
					</div>
					<!-- /.box-body -->
				  </div>

			  </div>
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
  <?php include('partial/footer.php'); ?>
</body>
</html>
