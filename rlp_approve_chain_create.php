<?php 
include 'header.php';
 ?>
<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
             Approve Chain Create
             <a href="rlp_approve_chain_list.php" style="float:right"><i class="fas fa-list"></i> Approve Chain List<a>
		</div>
        <div class="card-body">
        <?php include 'partial/rlp_approve_chain_create.php' ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php include 'footer.php' ?>