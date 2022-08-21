<?php 
include 'header.php';
$id=$_GET['id'];
?>
<style>

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
			<center>
				<img src="flats_photo/<?php echo $row['photo']; ?>" height="100px;"/>
				</br>Name : <?php echo $row['name']; ?>
			</center>
            <!--here your code will go-->
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>