<?php include('partial/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Announcement Details</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Announcement Details</li>
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
				<h2 class="d-inline"><span class="font-size-30">Announcement Details</span></h2>
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
				  <th>#</th>
				  <th>Member</th>
				  <th>Amount</th>
				  <th class="text-right">Paid</th>
				  <th class="text-right">Due</th>
				</tr>
				
				<?php			
				$code	=	$_GET['id'];
				$sql = "select * FROM `announcement` WHERE `code`='$code'";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) {
					?>
				<tr>
				  <td>2</td>
				  <td><?php echo $row['member_id'] ?></td>
				  <td><?php echo $row['amount'] ?></td>
				  <td class="text-right"><?php echo $row['paid'] ?></td>
				  <td class="text-right"><?php echo $row['amount'] - $row['paid'] ?></td>
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
