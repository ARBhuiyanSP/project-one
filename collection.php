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
        <li class="breadcrumb-item active">Collection Entry</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> Collection Entry Form
		</div>
        <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="bill-collection.php" method="post">
					<div class="row" id="div1" style="">
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
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="collection_submit" value="SAVE INFO" class="btn btn-primary btn-block" />
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