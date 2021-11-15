<?php 
include 'header.php';
?>
<!-- Left Sidebar End -->
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Flat Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Flat Entry Form
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
					<div class="row" id="div1" style="">
						<div class="col-md-3">
							<div class="form-group">
								<label>Code</label>
								<?php $prefix= 'F-'; ?>
								<input type="text" name="code" class="form-control" value="<?php echo getDefaultCategoryCode('flats', 'code', '03d', '001', $prefix) ?>" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Name</label>
							  <input name="name" type="text" class="form-control" placeholder="Name">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Status</label>
							  <select name="status" class="form-control">
								<option value="for_sale">For Sell</option>
								<option value="sold_out">Sold Out</option>
							  </select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Select Photo</label>
							  <input type="file" name="flatfileToUpload" id="picture">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Flat's Details</label>
								<textarea name="details" rows="3" class="form-control" placeholder="Flat's Details"></textarea>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="flat_submit" value="SAVE INFO" class="btn btn-primary btn-block" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<table id="dataTable" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
                                    $projectsData = getTableDataByTableName('flats');
                                    ;
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
									<tr>
										<td><?php echo $data['name']; ?></td>
										<td>
											<a href="#"><i class="fas fa-edit text-success"></i></a>
											<a href="#"><i class="fa fa-trash text-danger"></i></a>
										</td>
									</tr>
									<?php
                                        }
                                    }
                                    ?>
								</tbody>
							</table>
						</div>
					</div>
                </form>
            </div>
            <!--here your code will go-->
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>