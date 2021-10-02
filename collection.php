<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Collection Form</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Collection</li>
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
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Bill Collection</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Code</label>
										<input type="text" name="code" class="form-control" value="<?php echo getDefaultCategoryCode('announcement_master', 'code', '03d', '001', 'AN-') ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Date</label>
										<input type="date" name="date" class="form-control" value="">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Member</label>
									  <select name="status" class="form-control">
										<option value="for_sale">For Sell</option>
										<option value="sold_out">Sold Out</option>
									  </select>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Announcement ID</label>
									  <select name="status" class="form-control">
										<option value="for_sale">For Sell</option>
										<option value="sold_out">Sold Out</option>
									  </select>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Payable Amount</label>
									  <input name="payableamount" id="payableamount" type="text" class="form-control" placeholder="Amount For">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Pay</label>
									  <input name="pay" id="pay" type="text" class="form-control" placeholder="Amount For">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Payment Type</label>
									  <select name="status" class="form-control">
										<option value="Cash">Cash</option>
										<option value="Bank">Bank</option>
										<option value="Check">Check</option>
									  </select>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Due</label>
									  <input name="due" id="due" type="text" class="form-control" placeholder="Amount For">
									</div>
								  </div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="submit" name="announcement_submit" value="Collect Amount" class="btn btn-rounded btn-primary btn-outline" />
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
