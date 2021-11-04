<?php include('partial/header.php'); ?>

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
						<form action="bill-collection.php" method="post">
							<div class="box-body">
								<h4 class="box-title text-info"><i class="ti-user mr-15"></i> Bill Collection</h4>
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label>Member</label>
									  <?php 
											// Fetch all the country data 
											$query = "SELECT * FROM members"; 
											$result = $conn->query($query); 
										?>

										<!-- Country dropdown -->
										<select name="member" id="member" class="form-control">
											<option value="">Select Member</option>
											<?php 
											if($result->num_rows > 0){ 
												while($row = $result->fetch_assoc()){  
													echo '<option value="'.$row['member_id'].'">'.$row['name'].'</option>'; 
												} 
											}else{ 
												echo '<option value="">Member not available</option>'; 
											} 
											?>
										</select>
									</div>
								  </div>
								  <div class="col-md-3">
									<div class="form-group">
									  <label>Announcement ID</label>
									  <select name="announcement" id="announcement" class="form-control">
										<option value="">Select Member First</option>
									  </select>
									</div>
								  </div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="submit" name="collection_submit" value="Next" class="btn btn-rounded btn-primary btn-outline" />
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