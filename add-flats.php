<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Flat Add Form</h3>
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
						<form class="form">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Personal Info</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label>First Name</label>
									  <input type="text" class="form-control" placeholder="First Name">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Last Name</label>
									  <input type="text" class="form-control" placeholder="Last Name">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label >E-mail</label>
									  <input type="text" class="form-control" placeholder="E-mail">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label >Contact Number</label>
									  <input type="text" class="form-control" placeholder="Phone">
									</div>
								  </div>
								</div>
								<h4 class="box-title text-info"><i class="ti-save mr-15"></i> Requirements</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label>Company</label>
								  <input type="text" class="form-control" placeholder="Company Name">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Interested in</label>
									  <select class="form-control">
										<option>Interested in</option>
										<option>design</option>
										<option>development</option>
										<option>illustration</option>
										<option>branding</option>
										<option>video</option>
									  </select>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Budget</label>
									  <select class="form-control">
										<option>Budget</option>
										<option>less than 5000$</option>
										<option>5000$ - 10000$</option>
										<option>10000$ - 20000$</option>
										<option>more than 20000$</option>
									  </select>
									</div>
								  </div>
								</div>
								<div class="form-group">
								  <label>Select File</label>
								  <label class="file">
									<input type="file" id="file">
								  </label>
								</div>
								<div class="form-group">
								  <label>About Project</label>
								  <textarea rows="5" class="form-control" placeholder="About Project"></textarea>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
								  <i class="ti-trash"></i> Cancel
								</button>
								<button type="submit" class="btn btn-rounded btn-primary btn-outline">
								  <i class="ti-save-alt"></i> Save
								</button>
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
