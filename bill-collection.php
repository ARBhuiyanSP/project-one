<?php 
include('partial/header.php');

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Collection Form</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Collection</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">
			<div class="row">			  
				<div class="col-lg-12 col-12">
					  <div class="box">
						<!-- /.box-header -->
						<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Bill Collection / Invoice</h4>
								<hr class="my-15">
								<div class="row">
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
										<input name="member_id" type="text" class="form-control" value="<?php echo $member; ?>">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Announcement ID</label>
									  <input name="code" type="text" class="form-control" value="<?php echo $announcement; ?>">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Date</label>
										<input type="date" name="date" class="form-control" value="">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Total Amount</label>
									  <input name="" type="text" class="form-control" value="<?php echo $row['amount']; ?>">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Paid</label>
									  <input name="" type="text" class="form-control" value="<?php echo $row['paid']; ?>">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Amount Due</label>
									  <input name="" type="text" class="form-control" value="<?php echo $due; ?>">
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Pay Amount</label>
									  <input name="payamount" type="number" class="form-control" min="1" max="<?php echo $due; ?>" value="" required>
									</div>
								  </div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="submit" name="bill_submit" value="Collect Bill" class="btn btn-rounded btn-primary btn-outline" />
							</div>  
						</form>
					  </div>
					  <!-- /.box -->			
				</div>  
		    </div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  
  <?php include('partial/footer.php'); ?>
</body>
</html>
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