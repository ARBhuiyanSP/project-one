<?php 
include 'header.php';
?>
<?php  

?>
<style>
.table th, .table td{
	padding: 5px !important;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
</style>
<!-- Left Sidebar End -->
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Flat Entry</li>
    </ol>
	<div class="row">
		<div class="col-md-3">
			 <div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i> Flat Entry Form
				</div>
				<div class="card-body">
					<form method="post" action="" >
						<div class="form-group">
							<label>Buliding</label>
							<select class="form-control" id="building_id" name="building_id" >
								<?php
								$projectsData = getTableDataByTableName('buildings');
								;
								if (isset($projectsData) && !empty($projectsData)) {
									foreach ($projectsData as $data) {
										?>
										<option value="<?php echo $data['id']; ?>" <?php if (isset($building_id) && $building_id == $data['id']) {
									echo 'selected';
								} ?>><?php echo $data['name']; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
						</div>
						<div class="form-group">
							<?php if ($update == true): ?>
								<button class="btn btn-success btn-block" type="submit" name="flat_update">update</button>
							<?php else: ?>
								<button class="btn btn-info btn-block" type="submit" name="save" >Save</button>
							<?php endif ?>
						</div>
					</form>
					<?php if (isset($_SESSION['message'])): ?>
						<div class="msg">
							<?php 
								echo $_SESSION['message']; 
								unset($_SESSION['message']);
							?>
						</div>
					<?php endif ?>
				</div>
			 </div>
		</div>
		<div class="col-md-9">
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i> Flat List
				</div>
				<div class="card-body">
					
					<table id="dataTable" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Building</th>
								<th>Floor</th>
								<th>Unit/Flat Name</th>
								<th>Status</th>
								<th width="25%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$projectsData = getTableDataByTableName('flat_units');
								if (isset($projectsData) && !empty($projectsData)) {
									foreach ($projectsData as $data) {
							
							
							?>
							<tr style="background-color:<?php if($data['status'] == 'ForSale'){echo '#72c2aa';}else{echo '#b89069';} ?>">
								<td>
									<?php 
										$dataresult =   getDataRowByTableAndId('buildings', $data['building_id']);
										echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td>
									<?php 
										$dataresult =   getDataRowByTableAndId('floors', $data['floor_id']);
										echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td><?php echo $data['name']; ?></td>
								<td><?php echo $data['status']; ?></td>
								<td>
									<button class="btn btn-sm btn-info" onclick="window.location.href='flat-details.php?id=<?php echo $data['id']; ?>'"><i class="fas fa-eye"></i></button>
									
									<a href="flats.php?edit=<?php echo $data['id']; ?>"><button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button></a>
									
									<?php if($data['status'] == 'ForSale'){ ?>
										<button class="btn btn-sm btn-success" title="Sale" onclick="window.location.href='flat-sale.php?id=<?php echo $data['id']; ?>'"><i class="fas fa-funnel-dollar"></i></button>
									<?php }?>
									
									<a href="flats.php?del=<?php echo $data['id']; ?>"><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></a>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			 </div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>