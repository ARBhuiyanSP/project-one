<?php include 'header.php';
$warehouse_id	=	$_SESSION['logged']['warehouse_id'];
 ?>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
table tbody tr{
	background-color:#E9ECEF;
	color:#000;
}
.table th, .table td {
	padding:2px;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<div class="container-fluid">
<!-- Breadcrumbs-->
	<div class="row">
		<div class="col-xl-6 col-sm-6 mb-4">
			<div class="card text-white bg-info o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-truck"></i>
					</div>
				<?php
				
				$sqlmem	=	"SELECT * FROM `members` WHERE `status` = 'active'";
				$resultmem = mysqli_query($conn, $sqlmem);
				$totalmem = mysqli_num_rows($resultmem);
				?>
					<div class="mr-5"><?php echo $totalmem; ?> Active Member</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="member.php">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
		</div>
		<div class="col-xl-6 col-sm-6 mb-4">
			<div class="card text-white bg-info o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-truck"></i>
					</div>
				<?php
				
				$sqlcol		=	"SELECT sum(deposit_amount) FROM `balance_sheet` WHERE `type` = 'collection'";
				$resultcol 	= 	mysqli_query($conn, $sqlcol);
				$rowcol	 	= 	mysqli_fetch_row($resultcol);
				$sumcol		= 	$rowcol[0];
				?>
					<div class="mr-5"><?php echo $sumcol; ?> Total Collection</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="collection-list.php">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
		</div><!--
		<div class="col-xl-4 col-sm-6 mb-4">
			<div class="card text-white bg-info o-hidden h-100">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-truck"></i>
					</div>
				<?php
				if($_SESSION['logged']['user_type'] == 'superAdmin') {
					$sqlpmrr	=	"SELECT * FROM `inv_return` WHERE `approval_status` = '0'";
				}else{
					$sqlpmrr	=	"SELECT * FROM `inv_return` WHERE `warehouse_id`='$warehouse_id' AND `approval_status` = '0'";
				}
				
				$resultpmrr = mysqli_query($conn, $sqlpmrr);
				$totalPendingMrr = mysqli_num_rows($resultpmrr);
				?>
					<div class="mr-5"><?php echo $totalPendingMrr; ?> Pending Return</div>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="return-list.php">
				<span class="float-left">View Details</span>
				<span class="float-right">
					<i class="fas fa-angle-right"></i>
				</span>
				</a>
			</div>
		</div> -->
	</div>
</div>
      <!-- /.container-fluid -->
<?php include 'footer.php' ?>