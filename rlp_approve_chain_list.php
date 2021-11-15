<?php 
include 'header.php';
 ?>
<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
             List
             <a href="rlp_approve_chain_create.php" style="float:right"><i class="fas fa-plus"></i> Approve Chain Create<a>
		</div>
        <div class="card-body">
        <?php include 'partial/rlp_approve_chain_list.php'; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>