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
						<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Flat Info</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Code</label>
									  <?php 
											$prefix= 'F-';
										?>
                                <input type="text" name="code" class="form-control" value="<?php echo getDefaultCategoryCode('flats', 'code', '03d', '001', $prefix) ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Name</label>
									  <input name="name" type="text" class="form-control" placeholder="Name">
									</div>
								  </div>
								</div>
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Status</label>
									  <select name="status" class="form-control">
										<option value="for_sale">For Sell</option>
										<option value="sold_out">Sold Out</option>
									  </select>
									</div>
								  </div>
								</div>
								<div class="form-group">
								  <label>Select File</label>
								  <label class="file">
									<input type="file" name="flatfileToUpload" id="picture">
								  </label>
								</div>
								<div class="form-group">
								  <label>Flat's Details</label>
								  <textarea name="details" rows="3" class="form-control" placeholder="Flat's Details"></textarea>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="submit" name="flat_submit" value="SAVE INFO" class="btn btn-rounded btn-primary btn-outline" />
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
