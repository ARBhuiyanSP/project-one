<?php
/*******************************************************************************
 * The following code will
 * Insert Building Info at buildings table
 */
if (isset($_POST['building_submit']) && !empty($_POST['building_submit'])) {
		// insert data into buildings table
        $name			= $_POST['name'];
        $address		= $_POST['address'];    
        $no_of_floor	= $_POST['no_of_floor'];     
        $no_of_unit		= $_POST['no_of_unit'];     
               
        $query = "INSERT INTO `buildings` (`name`,`address`,`status`) VALUES ('$name','$address','active')";
        $conn->query($query);
		$last_inserted_buliding_id=$conn->insert_id;
	
			// insert data into floor table
			$limit = number_to_alphabet($no_of_floor);
			for($x = "A", $limit++; $x != $limit; $x++) {
				$name = $x;
				$query2 = "INSERT INTO `floors`(`building_id`,`name`) VALUES ('$last_inserted_buliding_id','$name')";
				$conn->query($query2);
				$last_inserted_floor_id=$conn->insert_id;
					// insert data into falt_units table
					$unit	=	$no_of_unit + 1;
					for ($i = 1; $i < $unit; $i++) {
						$name = $x.'-'.$i;
						// etc.
						$query2 = "INSERT INTO `flat_units`(`floor_id`,`building_id`,`name`,`status`) VALUES ('$last_inserted_floor_id','$last_inserted_buliding_id','$name','ForSale')";
						$conn->query($query2);
					}

			}
        
		$_SESSION['success']    =   "Building Entry process have been successfully completed.";
		header("location: building_entry.php");
		exit();
}


/*******************************************************************************
 * The following code will
 * Update Project Info at projects table
 */

if(isset($_POST['package_update_submit']) && !empty($_POST['package_update_submit'])){
    $receive_total      =   0;
    $no_of_material     =   0;
    $edit_id            =   $_POST['edit_id'];
    $mrr_no             =   $_POST['mrr_no'];
    
    // first delete all from inv_receivedetail; 
    $delsql    = "DELETE FROM inv_receivedetail WHERE mrr_no='$mrr_no'";
    $conn->query($delsql);
    // first delete all from inv_materialbalance; 
    $delsq2    = "DELETE FROM inv_materialbalance WHERE mb_ref_id='$mrr_no'";
    $conn->query($delsq2);
    
    for ($count = 0; $count < count($_POST['quantity']); $count++) {
        $mrr_date           = $_POST['mrr_date'];        
        $purchase_id        = $_POST['purchase_id'];
        $Purchase_date      = $_POST['Purchase_date'];
        $challan_no         = $_POST['challan_no'];
        $challan_date       = $_POST['challan_date'];
        $requisition_no     = $_POST['requisition_no'];
        $requisition_date   = $_POST['requisition_date'];
        $supplier_name      = $_POST['supplier_name'];
        $supplier_id        = $_POST['supplier_id'];


        $material_name      = $_POST['material_name'][$count];
        $material_id        = $_POST['material_id'][$count];
        $unit               = $_POST['unit'][$count];
        $part_no            = $_POST['part_no'][$count];
        $quantity           = $_POST['quantity'][$count];
        $no_of_material     = $no_of_material+$quantity;
        $unit_price         = $_POST['unit_price'][$count];
        $totalamount        = $_POST['totalamount'][$count];
        $receive_total      = $receive_total+$totalamount;
        $project_id         = $_POST['project_id'];
        $remarks            = $_POST['remarks'];

        $query = "INSERT INTO `inv_receivedetail` (`mrr_no`,`material_id`,`unit_id`,`receive_qty`,`unit_price`,`sl_no`,`total_receive`,`part_no`) VALUES ('$mrr_no','$material_id','$unit','$quantity','$unit_price','1','$totalamount','$part_no')";
        $conn->query($query);
        /*
         *  Insert Data Into inv_materialbalance Table:
        */
        $mb_ref_id      = $mrr_no;
        $mb_materialid  = $material_id;
        $mb_date        = (isset($Purchase_date) && !empty($Purchase_date) ? date('Y-m-d h:i:s', strtotime($Purchase_date)) : date('Y-m-d h:i:s'));
        $mbin_qty       = $quantity;
        $mbin_val       = $totalamount;
        $mbout_qty      = 0;
        $mbout_val      = 0;
        $mbprice        = $unit_price;
        $mbtype         = 'Receive';
        $mbserial       = '1.1';
        $mbunit_id      = $project_id;
        $mbserial_id    = 0;
        $jvno           = $mrr_no;
        $part_no        = $part_no;        
        
        $query_inmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`,`part_no`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbin_qty','$mbin_val','$mbout_qty','$mbout_val','$mbprice','$mbtype','$mbserial','$mbunit_id','$mbserial_id','$jvno','$part_no')";
        $conn->query($query_inmb);
    }
    /*
        *  Update Data Into inv_receive Table:
    */
    $query2    = "UPDATE inv_receive SET mrr_no='$mrr_no',mrr_date='$mrr_date',purchase_id='$purchase_id',receive_acct_id='16-001-001',supplier_id='$supplier_id',postedtogl='0',remarks='$remarks',receive_type='Credit',receive_ware_hosue_id='$project_id',receive_unit_id='1',receive_total='$receive_total',no_of_material='$no_of_material',challanno='$challan_no',requisitionno='$requisition_no',requisition_date='$requisition_date' WHERE id=$edit_id";
    $result2 = $conn->query($query2);
    
    /*
        *  Update Data Into inv_supplierbalance Table:
    */
    $query4    = "UPDATE inv_supplierbalance SET sb_ref_id='$mrr_no',sb_date='$mrr_date',sb_supplier_id='$supplier_id',sb_dr_amount='0',sb_cr_amount='$receive_total',sb_remark='$remarks',sb_partac_id='$mrr_no' WHERE sb_ref_id='$mrr_no'";
    $result2 = $conn->query($query4);
    
    $_SESSION['success']    =   "Receive process have been successfully updated.";
    header("location: receive_edit.php?edit_id=".$edit_id);
    exit();
}



/* FFlat-units process*/
	// initialize variables
	$building_id = "";
	$name = "";
	$id = 0;
	$update = false;
	if (isset($_POST['save'])) {
		$building_id = $_POST['building_id'];
		$name = $_POST['name'];

		mysqli_query($conn, "INSERT INTO flat_units (building_id,name) VALUES ('$building_id','$name')"); 
		$_SESSION['message'] = "Nmae saved"; 
		//header('location: flats.php');
	}
	
	if (isset($_POST['flat_update'])) {
	$id = $_POST['id'];
	$building_id = $_POST['building_id'];
	$name = $_POST['name'];

	mysqli_query($conn, "UPDATE flat_units SET building_id='$building_id', name='$name' WHERE id=$id");
	$_SESSION['message'] = "Name updated!"; 
	//header('location: flats.php');
}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($conn, "DELETE FROM flat_units WHERE id=$id");
	$_SESSION['message'] = "Name deleted!"; 
	//header('location: flats.php');
}

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM `flat_units` WHERE `id`=$id");
		$count = $record->num_rows;
		if ($count == 1 ) {
			$n = mysqli_fetch_array($record);
			$building_id = $n['building_id'];
			$name = $n['name'];
		}
	}
$results = mysqli_query($conn, "SELECT * FROM flat_units");


/*Flat sale Process*/
if (isset($_POST['sale_submit']) && !empty($_POST['sale_submit'])) {
		// insert data into buildings table
        $owner_id		= $_POST['owner_id'];
        $building_id	= $_POST['building_id'];
        $floor_id		= $_POST['floor_id'];
        $flat_id		= $_POST['flat_id'];
        $ownership_date		= $_POST['ownership_date'];
        $payment_type		= $_POST['payment_type'];
        $price				= $_POST['price'];
        $down_payment		= $_POST['down_payment'];
        $due_payment		= $_POST['due_payment'];
        $instalment_qty		= $_POST['instalment_qty'];
        $instalment_amount	= $_POST['instalment_amount'];
		$flat_status	= 'SoldOut';
               
        $query = "INSERT INTO `flat_owners` (`flat_id`,`owner_id`,`ownership_date`,`payment_type`,`instalment_amount`) VALUES ('$flat_id','$owner_id','$ownership_date','$payment_type','$instalment_amount')";
        $conn->query($query);
		
		
		$queryupdate   = "UPDATE `flat_units` SET `status`='$flat_status',`price`='$price',`down_payment`='$down_payment',`instalment_qty`='$instalment_qty',`instalment_amount`='$instalment_amount' WHERE `id`='$flat_id'";
		$resultupdate = $conn->query($queryupdate);
		
		$querybalance = "INSERT INTO `balance_sheet`(`date`,`balance_ref`,`member_id`,`credit_amount`,`deposit_amount`,`type`) VALUES ('$ownership_date','down_payment','$owner_id','$down_payment','0','credit')";
		$conn->query($querybalance);
		
		$querybalance2 = "INSERT INTO `balance_sheet`(`date`,`balance_ref`,`member_id`,`credit_amount`,`deposit_amount`,`type`) VALUES ('$ownership_date','down_payment','$owner_id','0','$down_payment','deposit')";
		$conn->query($querybalance2);
        
		$_SESSION['success']    =   "Building Entry process have been successfully completed.";
		header("location: flats.php");
		exit();
}
?>