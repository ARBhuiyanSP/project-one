<?php 
include 'header.php';
$id=$_GET['id'];
?>
<style>
.form-control{
	height:28px;
}
.select2-container .select2-selection--single{
	height:28px;
}
</style>
<!-- Left Sidebar End -->
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Flat Details</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Flat Details
		</div>
        <div class="card-body">
            <!--here your code will go-->
			<?php
				$sql = "select * from `flat_units` where `id`='$id'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_array($result);
			?>
			<form action="" method="POST">
				<div class="row" id="div1" style="">
					<div class="col-xs-2">
						<div class="form-group">
						  <label>Date</label>
							<input type="text" name="ownership_date" id="challan_date" class="form-control" value="">
						</div>
					</div>
					<div class="col-xs-3">
						<div class="form-group">
							<label>Member</label>
							<select class="form-control select2" id="owner_id" name="owner_id" required >
								<option value=""> Select</option>
								<?php
								$projectsData = getTableDataByTableName('members');
								;
								if (isset($projectsData) && !empty($projectsData)) {
									foreach ($projectsData as $data) {
										?>
										<option value="<?php echo $data['member_id']; ?>"><?php echo $data['name']; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-xs-3">
						<div class="form-group">
							<label>Building Name</label>
							<?php 
								$dataresult =   getDataRowByTableAndId('buildings', $row['building_id']);
								$building_id = (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
							?>
							<input type="text" value="<?php echo $building_id; ?>" class="form-control" readonly >
							<input type="hidden" name="building_id" value="<?php echo $row['building_id']; ?>">
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Floor Name</label>
							<?php 
								$dataresult =   getDataRowByTableAndId('floors', $row['floor_id']);
								$floor_id = (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
							?>
							<input type="text" value="<?php echo $floor_id; ?>" class="form-control" readonly >
							<input type="hidden" name="floor_id" value="<?php echo $row['floor_id']; ?>">
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Flat Name</label>
							<?php 
								$dataresult =   getDataRowByTableAndId('flat_units', $row['id']);
								$flat_id = (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
							?>
							<input type="text" value="<?php echo $flat_id; ?>" class="form-control" readonly >
							<input type="hidden" name="flat_id" value="<?php echo $row['id']; ?>">
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Payment Type</label>
							<select class="form-control select2" id="payment_type" name="payment_type" required >
								<option value=""> Select</option>
								<option value="Cash"> Cash</option>
								<option value="Instalment"> Instalment</option>
							</select>
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Price</label>
							<input type="text" name="price" id="price" class="form-control" onkeyup="due()" >
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Down Payment</label>
							<input type="text" name="down_payment" id="downpayment" class="form-control" onkeyup="due()" >
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Due Payment</label>
							<input type="text" name="due_payment" id="duepayment" class="form-control" onchange="due()" readonly >
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>No of Instalment</label>
							<input type="text" name="instalment_qty" id="instqty" class="form-control" onkeyup="due()" >
						</div>
					</div>
					<div class="col-xs-2">
						<div class="form-group">
							<label>Instalment Amount</label>
							<input type="text" name="instalment_amount" id="instamount" class="form-control" readonly >
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<input type="submit" name="sale_submit" id="submit" class="btn btn-block" style="background-color:#007BFF;color:#ffffff;" value="Save" />   
						</div>
					</div>
				</div>
			</form>
            <!--here your code will go-->
        </div>
    </div>

</div>
<script>
	function due(){
		var price = document.getElementById('price').value;
		var downpayment = document.getElementById('downpayment').value;
		var duepayment = document.getElementById('duepayment').value;
		var instqty = document.getElementById('instqty').value;


		var result =  parseInt(price) - parseInt(downpayment);
		if (!isNaN(result)) {
			document.getElementById('duepayment').value = result.toFixed(0);
		}
		
		var result2 =  parseInt(duepayment) / parseInt(instqty);
		if (!isNaN(result2)) {
			document.getElementById('instamount').value = result2.toFixed(0);
		}
	}
	
</script>
<script>
    $(function () {
        $("#challan_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>