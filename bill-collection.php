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
        <li class="breadcrumb-item active">Bill Collection Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Bill Collection / Invoice
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
					<div class="row" id="div1" style="">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Member</label>
							  <?php 
									if (isset($_POST['collection_submit']) && !empty($_POST['collection_submit'])) {
										$member	=	$_POST['member'];
										$announcement	=	$_POST['announcement'];
										
										$sql = "select * FROM `announcement` WHERE `member_id`='$member' AND `code`='$announcement'";
										$result = mysqli_query($conn, $sql);
										$row = mysqli_fetch_array($result);
										
										$amount =	$row['amount']; 
										$paid =	$row['paid']; 
										$due =	$amount -  $paid;
									}
								?>
								<!-- Country dropdown -->
								<input name="member_id" type="text" class="form-control" value="<?php echo $member; ?>" readonly>
							</div>
						</div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Announcement ID</label>
									  <input name="code" type="text" class="form-control" value="<?php echo $announcement; ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Date</label>
										<input type="date" name="date" class="form-control" value="" required>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Total Amount</label>
									  <input name="" type="text" class="form-control" value="<?php echo $row['amount']; ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Paid</label>
									  <input name="" type="text" class="form-control" value="<?php echo $row['paid']; ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Due</label>
									  <input name="" type="text" class="form-control" value="<?php echo $due; ?>" readonly>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Pay Amount</label>
									  <input name="payamount" type="number" class="form-control" min="1" max="<?php echo $due; ?>" value="" required>
									</div>
								  </div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="bill_submit" value="SAVE INFO" class="btn btn-primary btn-block" />
							</div>
						</div>
					</div>
                </form>
            </div>
            <!--here your code will go-->
        </div>
    </div>

</div>
<script>
$(document).ready(function(){
    $('#member').on('change', function(){
        var memberID = $(this).val();
        if(memberID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'member_id='+memberID,
                success:function(html){
                    $('#announcement').html(html);
                }
            }); 
        }else{
            $('#announcement').html('<option value="">Select member first</option>');
        }
    });
    
});
</script>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>