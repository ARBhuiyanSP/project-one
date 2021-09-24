<?php
/*******************************************************************************
 * The following code will
 * Store Flat entry data.
 * There are 1 table to keet track on receive data. The are following:
 * 1. flats (Store single row)    
 * *****************************************************************************
 */
if (isset($_POST['flat_submit']) && !empty($_POST['flat_submit'])) {
	
	// check duplicate:
/* 	$code		= $_POST['code'];
    $table		= 'flats';
    $where		= "code='$code'";
    if(isset($_POST['flat_update_submit']) && !empty($_POST['flat_update_submit'])){
        $notWhere   =   "id!=".$_POST['flat_update_submit'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
	if ($duplicatedata) {
		$status     =   'error';
		$_SESSION['warning']    =   "Operation faild. Duplicate data found..!";
    }else{ */
			
	// Store Data:
	$code 				= $_POST['code'];
	$name 				= $_POST['name'];
	$details 			= $_POST['details'];
	$status 			= $_POST['status'];
	
	if (is_uploaded_file($_FILES['flatfileToUpload']['tmp_name'])) 
	  {
		$photo=time()."_".$_FILES['flatfileToUpload']['name'];
		$temp_file=$_FILES['flatfileToUpload']['tmp_name'];
		
		 move_uploaded_file($temp_file,"flats_photo/".$photo);
	  }
       
		$query = "INSERT INTO `flats`(`code`,`name`,`details`,`photo`,`status`) VALUES ('$code','$name','$details','$photo','$status')";
        $conn->query($query);
		
		
    
		$_SESSION['success']    =   "Flat Entry process have been successfully completed.";
		header("location: flat_list.php");
		exit();
/* 	}
 */}



// Flat data Update:

if(isset($_POST['asset_update_submit']) && !empty($_POST['asset_update_submit'])){
    //$receive_total      =   0;
		

		$sl_no 				= $_POST['sl_no'];
		
		$company_id			= $_POST['company_id'];
		$division_id		= $_POST['division_id'];
		$department_id		= $_POST['department_id'];
		$proloc_id			= $_POST['proloc_id'];
	
	
		
		if (is_uploaded_file($_FILES['slfileToUpload']['tmp_name'])) 
				{
					$temp_file=$_FILES['slfileToUpload']['tmp_name'];
					$slimg=time().$_FILES['slfileToUpload']['name'];
					$q = move_uploaded_file($temp_file,"products_photo/".$slimg);
				}
				else
				{
				 $slimg = $_POST["old_slfileToUpload"];
				}

		if (is_uploaded_file($_FILES['profileToUpload']['tmp_name'])) 
				{
					$temp_file=$_FILES['profileToUpload']['tmp_name'];
					$proimg=time().$_FILES['profileToUpload']['name'];
					$q = move_uploaded_file($temp_file,"products_photo/".$proimg);
				}
				else
				{
				 $proimg = $_POST["old_profileToUpload"];
				}
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `sl_no`='$sl_no',`company_id`='$company_id',`division_id`='$division_id',`department_id`='$department_id',`proloc_id`='$proloc_id',`assets_category`='$assets_category',`item_name`='$item_name',`assets_description`='$assets_description',`brand`='$brand',`model`='$model',`manu_sl`='$manufacturing_sl',`rlp_no`='$rlp_no', `purchase_order`='$purchase_order',`delivery_challam`='$delivery_chalan',`vendor_name`='$vendor_name',`puchase_date`='$purchase_date',`warrenty`='$warrenty',`purchase_value`='$purchase_value',`origin`='$origin',`custody`='$custody',`status`='$status',`conditions`='$condition',`photo`='$slimg',`pro_photo`='$proimg',`qr_image`='$pngAbsoluteFilePath',`store_id`='$store_id',`current_store`='$store_id',`received_by`='$received_by' WHERE `id`='$id'";
		$resultupdate = $conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset UPDATE process have been successfully updated.";
		header("location: assets_edit.php?id=".$id);
		exit();
		
}

if(isset($_POST['assign_submit'])){
        $product_id 	= $_POST['product_id'];
		$employee_id 	= $_POST['employee_id'];
		$assign_date 	= $_POST['assign_date'];
		$remarks 		= $_POST['remarks'];
		$status 		= 'Active';
		$create 		= date('Y-m-d');
		$assigned_by 		= $_POST['assigned_by'];
		
		/* Insert Data Into product_assign Table: */
		
		$query = "INSERT INTO `product_assign`(`product_id`,`employee_id`,`assign_date`,`remarks`,`assigned_by`,`status`,`created_at`) VALUES ('$product_id','$employee_id','$assign_date','$remarks','$assigned_by','$status','$create')";
        $conn->query($query);
		$last_id = $conn->insert_id;
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `assign_status`='assigned' WHERE `id`='$product_id'";
		$conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
		header("location: assign-list.php");
		exit();

}


?>