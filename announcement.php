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
        <li class="breadcrumb-item active">Announcement Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Announcement Entry Form
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
					<div class="row" id="div1" style="">
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
						<!-- <div class="col-md-3">
							<div class="form-group">
							  <label>Amount</label>
							  <input name="amount" type="text" class="form-control" placeholder="Amount">
							</div>
						</div> -->
						<div class="col-md-3">
							<div class="form-group">
							  <label>Amount For</label>
							  <input name="amount_for" type="text" class="form-control" placeholder="Amount For">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="announcement_submit" value="SAVE INFO" class="btn btn-primary btn-block" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<table id="dataTable" class="table table-bordered table-striped table-hover">
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
                                    $projectsData = getTableDataByTableName('announcement_master');
                                    ;
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
									<tr>
										<td><?php echo $data['code']; ?></td>
										<td><?php echo $data['amount']; ?></td>
										<td><?php echo $data['amount_for']; ?></td>
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