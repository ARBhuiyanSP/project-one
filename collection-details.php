<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Collection Details</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Collection Details</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="invoice printableArea">
		  <div class="row">
			<div class="col-12">
			  <div class="bb-1 clearFix">
				<div class="text-right pb-15">
					<button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
				</div>	
			  </div>
			</div>
			<div class="col-12">
			  <div class="page-header">
				<h2 class="d-inline"><span class="font-size-30">Collection Details</span></h2>
				<div class="pull-right text-right">
					<h3></h3>
				</div>	
			  </div>
			</div>
			<!-- /.col -->
		  </div>
		  <div class="row">
			<div class="col-12 table-responsive">
			  <table class="table table-bordered">
				<tbody>
				<tr>
				  <th>Date</th>
				  <th>Amount</th>
				  <th>Payment Method</th>
				</tr>
				
				<?php			
				$id	=	$_GET['id'];
				$sql = "select * FROM `balance_sheet` WHERE `id`='$id'";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) {
					?>
				<tr>
				  <td><?php echo $row['date'] ?></td>
				  <td><?php echo $row['deposit_amount'] ?></td>
				  <td>Cash</td>
				</tr>
				<?php } ?>
				</tbody>
			  </table>
			</div>
			<!-- /.col -->
		  </div>
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
  <?php include('partial/footer.php'); ?>
</body>
</html>
