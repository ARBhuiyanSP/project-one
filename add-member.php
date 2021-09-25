<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Member Add Form</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Form</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">
			<div class="row">			  
				<div class="col-lg-12 col-12">
					  <div class="box">
						<!-- /.box-header -->
						<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Member Info</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Code</label>
									  <?php 
											$prefix= 'MID-';
										?>
										<input type="text" name="code" class="form-control" value="<?php echo getDefaultCategoryCode('members', 'code', '04d', '0001', $prefix) ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Name</label>
									  <input name="name" type="text" class="form-control" placeholder="Name">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Phone</label>
									  <input name="phone" type="text" class="form-control" placeholder="phone">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Email</label>
									  <input name="email" type="text" class="form-control" placeholder="email">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label>Address</label>
									  <input name="address" type="text" class="form-control" placeholder="Address">
									</div>
								  </div>
								</div>
								<div class="form-group">
								  <label>Select Member's Photo</label>
								  <label class="file">
									<input type="file" name="flatfileToUpload" id="picture">
								  </label>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="submit" name="member_submit" value="SAVE INFO" class="btn btn-rounded btn-primary btn-outline" />
							</div>  
						</form>
					  </div>
					  <!-- /.box -->			
				</div>  
		    </div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  
  <?php include('partial/footer.php'); ?>
</body>
</html>
