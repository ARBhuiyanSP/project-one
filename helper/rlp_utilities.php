<?php
function get_division_select_box(){
    include 'partial/division_select_box.php';
}
function get_department_select_box(){
    include 'partial/department_select_box.php';
}

function replace_dashes($string) {
    $string = str_replace("-", " ", $string);
    return $string;
}
function human_format_date($timestamp){
    return date("jS M, Y h:i:a", strtotime($timestamp)); //September 30th, 2013
}
function getDivisionNameById($id){
    global $conn;
    $table  =   "branch";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   '';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->name;
    }
    return $name;
}
function getDepartmentNameById($id){
    global $conn;
    $table  =   "department";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   '';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->name;
    }
    return $name;
}

function getPriorityName($id){
    global $conn;
    $table  =   "priority_details";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   'Urgent';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->name;
    }
    return $name;
}

function updateData($table, $dataParam, $where) {
    global $conn;
    $valueSets = array();
    foreach($dataParam as $key => $value) {
        if(isset($value) && !empty($value)){
            $valueSets[] = $key . " = '" . $value . "'";
        }
    }

    $conditionSets = array();
    foreach($where as $key => $value) {
       $conditionSets[] = $key . " = '" . $value . "'";
    }
    $sql = "UPDATE $table SET ". join(",",$valueSets) . " WHERE " . join(" AND ", $conditionSets);
    if ($conn->query($sql) === TRUE) {
        $feedbackData   =   [
            'status'    =>  'success',
            'message'   =>  'Data have been successfully Updated',
        ];
    } else {
        $feedbackData   =   [
            'status'    =>  'error',
            'message'   =>  "Error: " . $sql . "<br>" . $conn->error,
        ];        
    }
    return $feedbackData;
}

function getDataRowIdAndTableBySQL($sql){
    global $conn;
    $dataContainer  =   [];
    //echo $sql; exit;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_object()) {
            $dataContainer[] = $row;
        }
    }
    return $dataContainer;
}

function get_user_department_wise_rlp_chain_for_create(){
    $division_id    =   $_SESSION['logged']['branch_id'];
    $department_id  =   $_SESSION['logged']['department_id'];
    $table          =   "rlp_access_chain"
            . " WHERE chain_type='default'"
            . " AND division_id=$division_id"
            . " AND department_id=$department_id";
    $defaultChain       =   getDataRowIdAndTable($table);
    $defaultChainUsers  =   (isset($defaultChain) && !empty($defaultChain) ? json_decode($defaultChain->users) : "");
    include 'partial/rlp_chain_for_form.php';
}

function get_status_color($id){
    global $conn;
    $table  =   "status_details";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   '#FFDB58';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->bg_color;
    }
    return $name;
}
function get_status_name($id){
    global $conn;
    $table  =   "status_details";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   'Pending';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->name;
    }
    return $name;
}

function getAllDepartmentHeads($department_id){
    $table  =   "SELECT id,name,branch_id,department_id,project_id FROM users WHERE role_id=3 AND department_id=$department_id";
    $datas  =    getDataRowIdAndTableBySQL($table);
    return $datas;
}
function getAllApprovalBodies(){
    $table  =   "SELECT id,name,branch_id,department_id,project_id FROM users WHERE role_id IN (1)";
    $datas  =    getDataRowIdAndTableBySQL($table);
    return $datas;
}

function has_rlp_approved($rlp_id){
    global $conn;
    $table  =   "rlp_info";
    $sql = "SELECT * FROM $table WHERE id=$rlp_id";
    $result = $conn->query($sql);
    $is_approved   =   false;
    if ($result->num_rows > 0) {
        $is_approved   =   ($result->fetch_object()->rlp_status == 1 ? true : false);
    }
    return $is_approved;
}

function rlp_acknowledgement_is_pending($rlp_info_id, $ack_status){
    global $conn;    
    $table      =   "rlp_acknowledgement";
    $ack_status = implode(',', $ack_status);
    $sql        =   "SELECT * FROM $table WHERE rlp_info_id=$rlp_info_id AND ack_status IN($ack_status)";
    $result     =   $conn->query($sql);
    $is_pending =   true;
    if ($result->num_rows > 0) {
        $is_pending =   false;
    }    
    return $is_pending;
}

function get_next_rlp_visible_user($rlp_info_id){
    $table  =   "rlp_acknowledgement WHERE rlp_info_id=$rlp_info_id AND ack_status=0 AND is_visible=0 ORDER BY ack_order ASC LIMIT 1";
    $datas  =    getDataRowIdAndTable($table);
    if(isset($datas) && !empty($datas)){
        return $datas->id;
    }
    return false;
}

function set_rlp_visible_for_acknowledge($rlp_info_id){
    $id                 =   get_next_rlp_visible_user($rlp_info_id);
    if($id){
        $table          =   "rlp_acknowledgement";
        $dataParam      =   [
            'ack_request_date'  =>  date('Y-m-d H:i:s'),
            'is_visible'        =>  1
        ];
        $where      =   [
            'id'    =>  $id
        ];
        updateData($table, $dataParam, $where);
    }
}
function get_rlp_no($prefix="RLP", $formater_length=8){
    global $conn;
    
    $division_id    =   $_SESSION['logged']['branch_id'];
    $department_id  =   $_SESSION['logged']['department_id'];
    $department_id  =   $_SESSION['logged']['department_id'];
    $project_id      =   $_SESSION['logged']['project_id'];
    $user_id        =   $_SESSION['logged']['user_id'];
    
    $year       =   date("Y");
    $month      =   date("m");
    $sql        = "SELECT count('id') as total FROM rlp_info WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = $month AND is_delete=0 AND rlp_user_id=$user_id AND request_division=$division_id AND request_department=$department_id";
    $result     = $conn->query($sql);
    $total_row  =   $result->fetch_object()->total;
    
    $nextRLP    =   $total_row+1;
    $finalRLPNo = sprintf('%0' . $formater_length . 'd', $nextRLP);
    $divName    = replace_dashes(getDivisionNameById($division_id));
    $depName    = replace_dashes(getDepartmentNameById($department_id));
    
    return $prefix."-".$year."-".$month."-".$divName.'-'.$depName.'-'.$finalRLPNo;
}
function getDesignationByUserId($id){
    global $conn;
    $sql = "SELECT * FROM users where id=$id";
    $result = $conn->query($sql);
    $name   =   '';
    if ($result->num_rows > 0) {
        $users  = $result->fetch_object();
        return getDesignationNameById($users->designation);
    }
    return $name;
}
function getDesignationNameById($id){
    global $conn;
    $table  =   "designations";
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);
    $name   =   '';
    if ($result->num_rows > 0) {
        $name   =   $result->fetch_object()->name;
    }
    return $name;
}
function get_rlp_item_details($rlp_details){   
    $rlp_info       =   $rlp_details['rlp_info'];
    $rlp_details    =   $rlp_details['rlp_details'];
?>
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> RLP Details.
                <small class="pull-right">Priority: <?php echo getPriorityName($rlp_info->priority) ?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-8 invoice-col">
            From
            <address>
                <strong>Name:&nbsp;<?php echo $rlp_info->request_person ?></strong><br>
                Designation:&nbsp;<?php echo $rlp_info->designation ?><br>
                Department:&nbsp;<?php echo getNameByIdAndTable("department",$rlp_info->request_department) ?><br>
                Contact:&nbsp;<?php echo $rlp_info->contact_number ?><br>
                Email:&nbsp;Email: <?php echo $rlp_info->email ?>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <div class="pull-right">
                <b>RLP NO: &nbsp;<span class="rlpno_style"><?php echo $rlp_info->rlp_no ?></span></b><br>
                <b>Request Date:</b> <?php echo human_format_date($rlp_info->created_at) ?><br>
            </div>            
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Description</th>
                        <th>Purpose of Purchase</th>
                        <th>Quantity</th>
                        <th>Estimated Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl =   1;
                        foreach($rlp_details as $data){
                    ?>
                    <tr>
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo $data->item_des; ?></td>
                        <td><?php echo $data->purpose; ?></td>
                        <td><?php echo $data->quantity; ?></td>
                        <td><?php echo $data->estimated_price; ?></td>
                    </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<div class="clearfix"></div>
<?php }
function get_rlp_chain_assign_user_view($data){
    $users      =   $data['users'];
    $formType   =   $data['formType'];
    if (isset($users) && !empty($users)){
        if($formType  != 'access_form'){
            foreach ($users as $data) {            
                include '../partial/rlp_chain_assign_user_common_checkbox_view.php';
            }
        }else{
            include '../partial/department_users_dropdown.php';
        } ?>
    <?php }else{ ?>
        <div class="alert alert-warning">
            <strong>Warning!</strong> No user found with the Division And Department.
      </div>
<?php }
}
?>