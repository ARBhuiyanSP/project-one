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
        <li class="breadcrumb-item active">Member Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Member Entry Form
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
					<div class="row" id="div1" style="">
						<div class="col-md-3">
							<div class="form-group">
							<label>Code</label>
							<?php $prefix= 'MID-';?>
							<input type="text" name="code" class="form-control" value="<?php echo getDefaultCategoryCode('members', 'member_id', '04d', '0001', $prefix) ?>" readonly>
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
								<label>Phone</label>
								<input name="phone" type="text" class="form-control" placeholder="phone">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input name="email" type="text" class="form-control" placeholder="email">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>NID No</label>
								<input name="nid" type="text" class="form-control" placeholder="NID No">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Address</label>
								<input name="address" type="text" class="form-control" placeholder="Address">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Select Member's Photo</label>
								<input class="form-control" type="file" name="flatfileToUpload" id="picture">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="member_submit" value="SAVE INFO" class="btn btn-primary btn-block" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<table id="dataTable" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Member ID</th>
										<th>Name</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
                                    $projectsData = getTableDataByTableName('members');
                                    ;
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
									<tr>
										<td><?php echo $data['member_id']; ?></td>
										<td><?php echo $data['name']; ?></td>
										<td><?php echo $data['address']; ?></td>
										<td><?php echo $data['phone']; ?></td>
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