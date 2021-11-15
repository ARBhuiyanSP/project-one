<?php include 'header.php' ?>
<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Collection List
			<a href="collection.php" style="float:right"><i class="fas fa-plus"></i> Collection Entry<a>
		</div>
        <div class="card-body">
			<div class="table-responsive data-table-wrapper">
				<table id="example" class="table table-striped table-bordered">
					<thead>
							<tr>
								<th>Date</th>
								<th>Member</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								$sql = "select * FROM `balance_sheet` WHERE `type`='collection'";
								//$sql = "select * from ams_products where `store_id`='$store_id'";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_array($result)) {
								?>
							<tr class="edit_tr" style="background-color:#212529;color:#ffffff;">
								<th><?php echo $row['date'] ?></th>
								<th><?php echo $row['member_id'] ?></th>
								<th><?php echo $row['deposit_amount'] ?></th>
								<th>
									<a href="#" class="btn btn-success"><i class="fa fa-edit"></i></a>
									<a href="collection-details.php?id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
								</th>
							</tr>
								<?php } ?>
						</tbody>				  
						<tfoot>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
				</table>
			</div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>