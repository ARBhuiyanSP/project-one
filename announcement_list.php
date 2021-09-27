<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Announcement List</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Announcement List</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
			  <div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th>Code</th>
								<th>Amount</th>
								<th>Amount For</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								$sql = "select * FROM `announcement_master`";
								
								
								//$sql = "select * from ams_products where `store_id`='$store_id'";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_array($result)) {
									?>
							<tr class="edit_tr" style="background-color:#64D55F;color:#ffffff;">
								
								<th><?php echo $row['code'] ?></th>
								<th><?php echo $row['amount'] ?></th>
								<th><?php echo $row['amount_for'] ?></th>
								<th>
									<a href="#" class="btn btn-success"><i class="fa fa-pencil"></i></a>
									<a href="announcement-details.php?id=<?php echo $row['code'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
								</th>
							</tr>
								<?php } ?>
						</tbody>				  
						<tfoot>
							<tr>
								<th>Code</th>
								<th>Amount</th>
								<th>Amount For</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
  <?php include('partial/footer.php'); ?>
	<!-- Vendor JS -->
	<script src="assets/vendor_components/datatable/datatables.min.js"></script>
	
	<!-- EduAdmin App -->
	<script src="js/pages/data-table.js"></script>
	

</body>
</html>
