<?php 
// Include the database config file 
include 'connection/connect.php';
 
if(!empty($_POST["member_id"])){ 
    // Fetch state data based on the specific country 
    $member = $_POST["member_id"];
	$query = "SELECT * FROM `announcement` WHERE `member_id` = '$member' AND `status` !='Paid' "; 
    $result = $conn->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select announcement</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['code'].'">'.$row['code'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">announcement not available</option>'; 
    } 
} 
?>