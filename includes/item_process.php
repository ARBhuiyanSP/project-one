<?php 
if (isset($_GET['process_type']) && $_GET['process_type'] == 'parent') {
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $status     =   'success';
    $message    =   'Current operation was successfully completed';
    $feedback   =   '';
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $parent_code = mysqli_real_escape_string($conn, $_POST['category_id']);
    // check duplicate:
    $table = 'inv_materialcategorysub';
//    $where = 'category_id=' . "$parent_code" . ' and category_description=' . "$name";
    $where = "category_id='$parent_code' and category_description='$name'";
    if(isset($_POST['parent_material_update_id']) && !empty($_POST['parent_material_update_id'])){
        $notWhere   =   "id!=".$_POST['parent_material_update_id'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
    if ($duplicatedata) {
        $status     =   'error';
        $message    =   'Current operation was faild. Duplicate data found!';
    } else {
        if (isset($_POST['parent_material_update_id']) && !empty($_POST['parent_material_update_id'])) {
            $edit_id = $_POST['parent_material_update_id'];
            $sql = "UPDATE inv_materialcategorysub SET category_id='$parent_code',category_description='$name' WHERE id=$edit_id";
            $status     =   'success';
            $message    =   'Data have been successfully updated!';
        } else {
            $sql = "INSERT INTO inv_materialcategorysub (category_description, category_id) VALUES ('" . $name . "', '" . $parent_code . "')";
            $status     =   'success';
            $message    =   'Data have been successfully inserted!';
        }
        if ($conn->query($sql) === TRUE) {
            $feedback = parent_category_table_json_response('parent_category');
        }
    }
    $data   =   [
        'status'    =>  $status,
        'message'   =>  $message,
        'data'      =>  $feedback,
    ];
    echo json_encode($data);
}
function parent_category_table_json_response($tableName) {
    $feedback   =   '';
    $tableData = getTableDataByTableName('inv_materialcategorysub', '' , 'category_description');
    if (isset($tableData) && !empty($tableData)) {
        foreach ($tableData as $data) {
            $category_id                =   $data['category_id'];
            $category_description       =   $data['category_description'];
            $id                =   $data['id'];
            $feedback.="<tr>
                <td>$category_id</td>
                <td>$category_description</td>
                <td>
                    <button type=\"button\" class=\"btn btn-sm\" onclick=\"openParentEditForm('$id');\">
                        <i class=\"fa fa-edit\" aria-hidden=\"true\"></i>
                    </button>
                </td>
            </tr>";
        }// end of foreach;
    }
    return $feedback;
}
if (isset($_GET['process_type']) && $_GET['process_type'] == 'sub_cat') {
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $status     =   'success';
    $message    =   'Current operation was successfully completed';
    $feedback   =   '';
    $parent_id  = mysqli_real_escape_string($conn, $_POST['parent_id']);
    $sub_code   = mysqli_real_escape_string($conn, $_POST['sub_code']);
    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    // check duplicate:
    $table = 'inv_materialcategory';
//    $where = 'category_id=' . "$parent_code" . ' and category_description=' . "$name";
    $where = "category_id='$parent_id' and material_sub_id='$sub_code' and material_sub_description='$name'";
    if(isset($_POST['sub_material_update_id']) && !empty($_POST['sub_material_update_id'])){
        $notWhere       =   "id!=".$_POST['sub_material_update_id'];
        $duplicatedata  = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata  = isDuplicateData($table, $where);
    }
    if ($duplicatedata) {
        $status  = 'error';
        $message = 'Current operation was faild. Duplicate data found!';
    } else {
        if (isset($_POST['sub_material_update_id']) && !empty($_POST['sub_material_update_id'])) {
            $edit_id     = $_POST['sub_material_update_id'];
            $sql         = "UPDATE inv_materialcategory SET material_sub_id='$sub_code',category_id='$parent_id',material_sub_description='$name' WHERE id=$edit_id";
            $status      = 'success';
            $message     = 'Data have been successfully updated!';
        } else {
            $sql         = "INSERT INTO inv_materialcategory (category_id, material_sub_description, material_sub_id) VALUES ('" . $parent_id . "','" . $name . "', '" . $sub_code . "')";
            $status      = 'success';
            $message     = 'Data have been successfully inserted!';
        }

        if ($conn->query($sql) === TRUE) {
            $feedback = sub_category_table_json_response('inv_materialcategory');
        }
    }

    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $feedback,
    ];
    echo json_encode($data);
}
function sub_category_table_json_response($tableName) {
    $feedback   =   '';
    $tableData = getTableDataByTableName('inv_materialcategory','','material_sub_description');
    if (isset($tableData) && !empty($tableData)) {
        foreach ($tableData as $data) {
            $id                         =   $data['id'];
            $dataresult                 =   getDataRowByTableAndId('inv_materialcategorysub', $data['category_id']);
            $category_description       = (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : '');
            $material_sub_id            =  $data['material_sub_id'];
            $material_sub_description   =  $data['material_sub_description'];
            $feedback.="<tr>
                <td>
                    $category_description
                </td>
                <td>$material_sub_id</td>
                <td>$material_sub_description</td>
                <td>
                    <button type=\"button\" class=\"btn btn-sm\" onclick=\"openSubMaterialEditForm('$id');\">
                        <i class=\"fa fa-edit\" aria-hidden=\"true\"></i>
                    </button>
                </td>
            </tr>";
        }
    }
    return $feedback;
}
if(isset($_GET['process_type']) && $_GET['process_type'] == 'item'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $status     =   'success';
    $message    =   'Current operation was successfully completed';
    $feedback   =   '';
    $parent_id          =   mysqli_real_escape_string($conn, $_POST['parent_item_id']);
    $sub_item_id        =   mysqli_real_escape_string($conn, $_POST['sub_item_id']);
    $item_code          =   mysqli_real_escape_string($conn, $_POST['item_code']);
    $name               =   mysqli_real_escape_string($conn, $_POST['name']);
    $brand_name			=   mysqli_real_escape_string($conn, $_POST['brand_name']);
    $type				=   mysqli_real_escape_string($conn, $_POST['type']);
    $qty_unit           =   mysqli_real_escape_string($conn, $_POST['qty_unit']);
    $material_min_stock =   mysqli_real_escape_string($conn, $_POST['material_min_stock']);
    // check duplicate:
    $table = 'inv_material';
    $where = "material_id=".$parent_id." and material_sub_id='$sub_item_id' and material_id_code='$item_code' and material_description='$name'";
    if(isset($_POST['material_update_id']) && !empty($_POST['material_update_id'])){
        $notWhere   =   "id!=".$_POST['material_update_id'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
    if ($duplicatedata) {
        $status  = 'error';
        $message = 'Current operation was faild. Duplicate data found!';
    } else {
        if(isset($_POST['material_update_id']) && !empty($_POST['material_update_id'])){
            $edit_id     =   $_POST['material_update_id'];
            $sql         = "UPDATE inv_material SET material_id_code='$item_code',material_id='$parent_id',material_sub_id='$sub_item_id',material_description='$name',brand_name='$brand_name',type='$type',material_min_stock='$material_min_stock',qty_unit='$qty_unit' WHERE id=$edit_id";
            $status      = 'success';
            $message     = 'Data have been successfully updated!';            
        }else{
            $sql         = "INSERT INTO inv_material (material_id,material_sub_id,material_id_code,material_description,brand_name,type,material_min_stock,qty_unit) VALUES ('".$parent_id."','".$sub_item_id."', '".$item_code."','".$name."','".$brand_name."','".$type."', '".$material_min_stock."','".$qty_unit."')";
            $status      = 'success';
            $message     = 'Data have been successfully inserted!';
            
        }
        if ($conn->query($sql) === TRUE) {
            $feedback = item_table_json_response('inv_material');
        }
    }
    $data = [
        'status'    => $status,
        'message'   => $message,
        'data'      => $feedback,
    ];
    echo json_encode($data);
}
function item_table_json_response($tableName) {
    $feedback   =   '';
    $tableData = getTableDataByTableName($tableName, '', 'material_description');
    if (isset($tableData) && !empty($tableData)) {
        foreach ($tableData as $data) {
            $id                         =  $data['id'];
            $dataresult                 =  getDataRowByTableAndId('inv_materialcategorysub', $data['material_id']);
            $category_description       = (isset($dataresult) && !empty($dataresult) ? $dataresult->category_description : '');
            
            $datasubresult              =  getDataRowByTableAndId('inv_materialcategory', $data['material_sub_id']);
            $sub_category_description   =  (isset($dataresult) && !empty($dataresult) ? $datasubresult->material_sub_description : '');
            
            $material_id_code           =  $data['material_id_code'];
            $material_description       =  $data['material_description'];
            $material_min_stock         =  $data['material_min_stock'];
            $unit_name                  =  getDataRowByTableAndId('inv_item_unit', $data['qty_unit'])->unit_name;
            $feedback.="<tr>
                <td>
                    $category_description
                </td>
                <td>$sub_category_description</td>
                <td>$material_id_code</td>
                <td>$material_description</td>
                <td>$material_min_stock</td>
                <td>$unit_name</td>
                <td>
                    <button type=\"button\" class=\"btn btn-sm\" onclick=\"openMaterialEditForm('$id');\">
                        <i class=\"fa fa-edit\" aria-hidden=\"true\"></i>
                    </button>
                </td>
            </tr>";
        }
    }
    return $feedback;
}
if(isset($_GET['process_type']) && $_GET['process_type'] == 'get_sub_by_parent'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $parent_id      =    $_POST['parent_id'];
    $tableName      =    'inv_materialcategory where category_id='.$parent_id;
    $tableData      = getTableDataByTableName($tableName, '', 'material_sub_description');
    if (isset($tableData) && !empty($tableData)) {
        echo "<option value=''>Please Select</option>";
        foreach ($tableData as $data) { ?>
            <option value="<?php echo $data['id']; ?>"><?php echo $data['material_sub_description'].'('.$data['material_sub_id'].')'; ?></option>
            <?php
        }
    }
}



/*
 *   Category, Sub category and material
 */
if(isset($_GET['process_type']) && $_GET['process_type'] == 'material_edit'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $edit_id    =   $_POST['edit_id'];
    $editData   =   getDataRowByTableAndId('inv_material',$edit_id);
?> 
        <div class="modal_body_centerize"> 
            <input type="hidden" name="material_update_id" value="<?php echo $editData->id; ?>">
            <div class="form-group">
                <label class="control-label col-sm-5" for="parent_code">Parent Category:</label>
                <div class="col-sm-7">
                    <select class="form-control" id="edit_main_item_id" name="parent_item_id" onchange="getSubCategoryByParent(this.value, 'edit_sub_item_id');">
                        <option value="">Select</option>
                        <?php
                        $parentCats = getTableDataByTableName('inv_materialcategorysub', '', 'category_description');
                        if (isset($parentCats) && !empty($parentCats)) {
                            foreach ($parentCats as $pcat) {
                                ?>
                                <option value="<?php echo $pcat['id'] ?>" <?php if(isset($editData->material_id) && $editData->material_id == $pcat['id']){ echo 'selected'; } ?>><?php echo $pcat['category_description'].'('.$pcat['category_id'].')'; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="parent_code">Sub Category:</label>
                <div class="col-sm-7">
                    <select class="form-control" id="edit_sub_item_id" name="sub_item_id" onchange="getMatCodeBySubId(this.value, 'item_edit_code');">
                        <option value="">Select</option>
                        <?php
                        $parentCats = getTableDataByTableName('inv_materialcategory', '', 'material_sub_description');
                        if (isset($parentCats) && !empty($parentCats)) {
                            foreach ($parentCats as $pcat) {
                                ?>
                                <option value="<?php echo $pcat['id'] ?>"<?php if(isset($editData->material_sub_id) && $editData->material_sub_id == $pcat['id']){ echo 'selected'; } ?>><?php echo $pcat['material_sub_description'].'('.$pcat['material_sub_id'].')'; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="parent_code">Material Code:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="item_edit_code" placeholder="Enter item code" name="item_code" value="<?php if(isset($editData->material_id_code)){ echo $editData->material_id_code; } ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="name">Name:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="edit_item_name" placeholder="name" name="name" value="<?php if(isset($editData->material_description)){ echo $editData->material_description; } ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="name">Brand Name:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="edit_item_name" placeholder="brand name" name="brand_name" value="<?php if(isset($editData->brand_name)){ echo $editData->brand_name; } ?>">
                </div>
            </div>
			<div class="form-group">
                <label class="control-label col-sm-5" for="name">Type:</label>
                <div class="col-sm-7">
					<select class="form-control" id="type" name="type">
						<option value="<?php if(isset($editData->type)){ echo $editData->type; } ?>"><?php if(isset($editData->type)){ echo $editData->type; } ?></option>
						<option value="CIVIL">CIVIL</option>
						<option value="ELECTRICAL">ELECTRICAL</option>
						<option value="MACHANICAL">MACHANICAL</option>
						<option value="SANITARY">SANITARY</option>
						<option value="HARDWARE">HARDWARE</option>
					</select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="parent_code">Unit:</label>
                <div class="col-sm-7">
                    <select class="form-control" id="qty_unit" name="qty_unit">
                        <option value="">Select</option>
                        <?php
                        $parentCats = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                        if (isset($parentCats) && !empty($parentCats)) {
                            foreach ($parentCats as $pcat) {
                                ?>
                                <option value="<?php echo $pcat['id'] ?>" <?php if(isset($editData->qty_unit) && $editData->qty_unit == $pcat['id']){ echo 'selected'; } ?>><?php echo $pcat['unit_name'] ?></option>
<?php }
}
?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="name">Material min stock:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="material_min_stock" placeholder="Material min stock" name="material_min_stock" value="<?php if(isset($editData->material_min_stock)){ echo $editData->material_min_stock; } ?>">
                </div>
            </div>
        </div>
<?php }
if(isset($_GET['process_type']) && $_GET['process_type'] == 'sub_material_edit'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $edit_id    =   $_POST['edit_id'];
    $editData   =   getDataRowByTableAndId('inv_materialcategory',$edit_id);
?>
        <div class="form-group">
            <input type="hidden" name="sub_material_update_id" value="<?php echo $editData->id; ?>">
            <label class="control-label col-sm-5" for="parent_id">Parent Category:</label>
            <div class="col-sm-7">
                <select class="form-control" id="edit_parent_item_id" name="parent_id" onchange="getSubCodeByParenId(this.value, 'edit_sub_code');">
                    <option value="">Select</option>
                    <?php
                    $parentCats = getTableDataByTableName('inv_materialcategorysub', '', 'category_description');
                    if (isset($parentCats) && !empty($parentCats)) {
                        foreach ($parentCats as $pcat) {
                            ?>
                            <option value="<?php echo $pcat['id'] ?>"<?php if(isset($editData->category_id) && $editData->category_id == $pcat['id']){ echo 'selected'; } ?>><?php echo $pcat['category_description'].'('.$pcat['category_id'].')'; ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-5" for="sub_code">Sub Code:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="edit_sub_code" placeholder="Enter sub code" name="sub_code" value="<?php if(isset($editData->material_sub_id)){ echo $editData->material_sub_id; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-5" for="name">Name:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="edit_sub_name" placeholder="name" name="name" value="<?php if(isset($editData->material_sub_description)){ echo $editData->material_sub_description; } ?>">
            </div>
        </div>
<?php }

if(isset($_GET['process_type']) && $_GET['process_type'] == 'parent_material_edit'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $edit_id    =   $_POST['edit_id'];
    $editData   =   getDataRowByTableAndId('inv_materialcategorysub',$edit_id);
?>
        <div class="form-group">
            <input type="hidden" name="parent_material_update_id" value="<?php echo $editData->id; ?>">
            <label class="control-label col-sm-5" for="category_id">Category Id:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="edit_category_id" placeholder="Enter Category Id" name="category_id" value="<?php if(isset($editData->category_id)){ echo $editData->category_id; } ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-5" for="name">Name:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="edit_parent_name" placeholder="name" name="name" value="<?php if(isset($editData->category_description)){ echo $editData->category_description; } ?>">
            </div>
        </div>
<?php }
if(isset($_GET['process_type']) && $_GET['process_type'] == 'get_parent_category'){
    include '../connection/connect.php';
    include '../helper/utilities.php';
    echo "<option value=''>Please Select</option>";
    $tableData      = getTableDataByTableName('inv_materialcategorysub', '', 'category_description');
    if (isset($tableData) && !empty($tableData)) {
        foreach ($tableData as $data) { ?>
            <option value="<?php echo $data['id']; ?>"><?php echo $data['category_description'].'('.$data['category_id'].')'; ?></option>
            <?php
        }
    }
}
if(isset($_GET['process_type']) && $_GET['process_type'] == 'get_category_code'){
    include '../connection/connect.php';
    $catType   =   $_POST['cat_type'];
    $data_type  =   $_POST['data_type'];
    global $conn;
    $sql            =   '';
    $defaultCode    =   '';    
    $feedback       =   '';    
    switch($catType){
        case 'parent':
            $table =    'inv_materialcategorysub';
            $sql.= "SELECT * FROM $table";
            if(isset($where) && !empty($where)){
                $sql.= $where;
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $value          =   $result->num_rows + 1;
                $code           =  sprintf('%0' . 2 . 's', $value);
                $defaultCode    =  $code.'-00-000';
            }else{
                $defaultCode    =  '01-00-000';
            }
            break;
        case 'sub':
            $psql= "SELECT * FROM inv_materialcategorysub where id=".$_POST['parent_cat'];
            $presult = $conn->query($psql);
            
            $table =    'inv_materialcategory';
            $where =    ' where category_id='.$_POST['parent_cat'];
            $sql.= "SELECT * FROM $table";
            if(isset($where) && !empty($where)){
                $sql.= $where;
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $parentPrefixcode   =  explode('-', $presult->fetch_object()->category_id);
                $code               =  sprintf('%0' . 2 . 's', $result->num_rows + 1);
                $defaultCode        =  $parentPrefixcode[0].'-'.$code.'-000';
            }else{
                $parentPrefixcode   =  explode('-', $presult->fetch_object()->category_id);
                $defaultCode        =  $parentPrefixcode[0].'-01'.'-000';
            }
            break;
        case 'mat':
            $psql       = "SELECT * FROM inv_materialcategorysub where id=".$_POST['parent_cat'];
            $presult    = $conn->query($psql);
            
            $ssql       = "SELECT * FROM inv_materialcategory where id=".$_POST['sub_id'];
            $sresult    = $conn->query($ssql);
            
            $table =    'inv_material';
            $where =    ' where material_id='.$_POST['parent_cat'].' and material_sub_id='.$_POST['sub_id'];
            $sql.= "SELECT * FROM $table";
            if(isset($where) && !empty($where)){
                $sql.= $where;
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $parentPrefixcode   =  explode('-', $presult->fetch_object()->category_id);
                $subPrefixcode      =  explode('-', $sresult->fetch_object()->material_sub_id);
                $code               =  sprintf('%0' . 3 . 's', $result->num_rows + 1);
                $defaultCode        =  $parentPrefixcode[0].'-'.$subPrefixcode[1].'-'.$code;
            }else{
                $parentPrefixcode   =  explode('-', $presult->fetch_object()->category_id);
                $subPrefixcode      =  explode('-', $sresult->fetch_object()->material_sub_id);
                $code               =  '001';
                $defaultCode        =  $parentPrefixcode[0].'-'.$subPrefixcode[1].'-'.$code;
            }
            break;
    }
    $feedback =  [
        'code' =>   $defaultCode
    ];
    echo json_encode($feedback);
}

if(isset($_GET['process_type']) && $_GET['process_type'] == 'getItemCodeByParam'){
    session_start();
    include '../connection/connect.php';
    include '../helper/utilities.php';
    $qty_unit   =   '';
    $table      =   $_POST['table']." where id=".$_POST['id'];
    $field      =   $_POST['field'];
    $code       = getItemCodeByParam($table, $field);
    if(isset($_POST['qty_unit']) && !empty($_POST['qty_unit'])){
        $qty_unit   = getItemCodeByParam($table, 'qty_unit');
    }

    // get material informtion for brand name:
    $materialData           =   getDataRowIdAndTable($table);
	
    // Get Opening quantity:
    $param                  =   [];
    $param['mb_materialid'] =   $code;
    $param['warehouse_id']  =   $_SESSION['logged']['warehouse_id'];
    
    $totalStock     =   get_product_stock_by_material_id($param);
    
    $feedback   =   [
        'status'    =>  'success',
        'message'   =>  'Found Code',
        'data'      =>  $code,
        'qty_unit'  =>  $qty_unit,
        'totalStock'  =>  $totalStock,
        'brand_name'  =>  (isset($materialData->brand_name) && !empty($materialData->brand_name) ? $materialData->brand_name : ''),
    ];    
    echo json_encode($feedback);
}
?>
