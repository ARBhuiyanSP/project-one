<?php
if (isset($_POST['change_submit']) && !empty($_POST['change_submit'])) { 
    $error_status   =   false;
    $error_string   =   [];
   
    if(isset($_POST['old_password']) && !empty($_POST['old_password'])){
        $old_password      =   mysqli_real_escape_string($conn, $_POST['old_password']);
        $old_password      =  md5($old_password);
    }else{
        $error_status                   =   true;
        $error_string['password_empty']    =   'old password is reqiored.';
    }
    
	
	
    if($error_status){
        foreach($error_string as $errorKey=>$errorVal){
            $_SESSION['error_message'][$errorKey]   =   $errorVal;            
        }
        $_SESSION['error']    =   "Something Error Detected";
        header("location: profile.php");
        exit();
    }else{
        $emailsql    = "SELECT * FROM users where email='$email'";
        $result = $conn->query($emailsql);
        if ($result->num_rows > 0) {
            $passsql    = "SELECT * FROM users where email='$email' AND password='$password'";
            $presult = $conn->query($passsql);
            if ($presult->num_rows > 0) {
                $row        	=   $presult->fetch_object();
                $fname      	=   $row->first_name;
                $lname      	=   $row->last_name;
                $user_id    	=   $row->id;
                $user_type		=   $row->user_type;
                $project_id		=   $row->project_id;
                $warehouse_id	=   $row->warehouse_id;
                unset($_SESSION['error']);
                $_SESSION['success']                =   $fname.' '.$lname." have successfully loggedin!";
                $_SESSION['logged']['user_name']    =   $fname.' '.$lname;
                $_SESSION['logged']['user_id']      =   $user_id;
                $_SESSION['logged']['user_type']	=   $user_type;
                $_SESSION['logged']['project_id']	=   $project_id;
                $_SESSION['logged']['warehouse_id']	=   $warehouse_id;

                $_SESSION['logged']['status']		=   true;
                header("location: dashboard.php");
                exit();
            }else{
                $error_status                       =   true;
                $_SESSION['error_message']['password_empty']     =   'Password did not matched.';
                $_SESSION['error']                               =   "Login credential was not correct.";
                header("location: index.php");
                exit();
            }
        }else{
            $error_status   =   true;
            $_SESSION['error_message']['email_valid']    =   'Invalid email';
            $_SESSION['error']                           =   "Login credential was not correct.";
            header("location: index.php");
            exit();
        }
    }
}