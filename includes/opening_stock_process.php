<?php
/*******************************************************************************
 * The following code will
 * Update Opening Stock Balance.
 * There are 2 table to keet track on receive data. The are following:
 * 1. inv_material (Update Multiple row)      
 * 2. inv_materialbalance (Update Multiple row)
 * *****************************************************************************
 */
if (isset($_POST['op_submit']) && !empty($_POST['op_submit'])) {
    for ($count = 0; $count < count($_POST['material_id_code']); $count++) {
        
        /*
         *  Update Qty Into inv_material Table:
        */ 
		
        $project_id				= $_POST['project_id'];
        $warehouse_id			= $_POST['warehouse_id'];
		$op_date                = $_POST['op_date'];
        $material_id_code		= $_POST['material_id_code'][$count];  
        $op_balance_qty			= $_POST['op_balance_qty'][$count];   
        $op_balance_val		    = $_POST['op_balance_val'][$count];          
        $mbprice				= $op_balance_qty *  $op_balance_val;
               
        $query = "UPDATE `inv_material` SET `op_balance_qty`='$op_balance_qty',`op_balance_val`='$op_balance_val' WHERE `material_id_code`='$material_id_code'";
        $conn->query($query); 
		/*
        *  Update Qty Into inv_materialbalance Table:
        */

		$query_inmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`project_id`,`warehouse_id`) VALUES ('$material_id_code','$material_id_code','$op_date','$op_balance_qty','$op_balance_val','0','0','$mbprice','OP','$project_id','$warehouse_id')";
		$conn->query($query_inmb);
				
    }
	
    
}
if (isset($_POST['op_edit']) && !empty($_POST['op_edit'])) {
    for ($count = 0; $count < count($_POST['material_id_code']); $count++) {
        
        /*
         *  Update Qty Into inv_material Table:
        */ 
		
        $project_id				= $_POST['project_id'];
        $warehouse_id			= $_POST['warehouse_id'];
		$op_date                = $_POST['op_date'];
        $material_id_code		= $_POST['material_id_code'][$count];  
        $op_balance_qty			= $_POST['op_balance_qty'][$count];   
        $op_balance_val		    = $_POST['op_balance_val'][$count];          
        $mbprice				= $op_balance_qty *  $op_balance_val;
               
        $query = "UPDATE `inv_material` SET `op_balance_qty`='$op_balance_qty',`op_balance_val`='$op_balance_val' WHERE `material_id_code`='$material_id_code'";
        $conn->query($query); 
		/*
        *  Update Qty Into inv_materialbalance Table:
        */
		
		$query_inmb	=	"UPDATE `inv_materialbalance` SET `mbin_qty`='$op_balance_qty',`mbin_val`='$op_balance_val',`mbprice`='$mbprice' WHERE `mb_materialid`='$material_id_code' AND `mbtype`='OP' AND `warehouse_id`='$warehouse_id'";
		$conn->query($query_inmb);
				
    }
	
    
}

?>