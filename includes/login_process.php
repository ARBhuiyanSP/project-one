<?php
if (isset($_POST['login_submit']) && !empty($_POST['login_submit'])) { 
    $error_status   =   false;
    $error_string   =   [];
    if(isset($_POST['username']) && !empty($_POST['username'])){
        $username      =   $_POST['username'];
        
    }else{
        $error_status                   =   true;
        $error_string['username_empty']    =   'username is required.';
    }
    if(isset($_POST['password']) && !empty($_POST['password'])){
        $password      =   mysqli_real_escape_string($conn, $_POST['password']);
        $password      =  md5($password);
    }else{
        $error_status                   =   true;
        $error_string['password_empty']    =   'Password is reqiored.';
    }
    
    if($error_status){
        foreach($error_string as $errorKey=>$errorVal){
            $_SESSION['error_message'][$errorKey]   =   $errorVal;            
        }
        $_SESSION['error']    =   "Login credential was not correct.";
        header("location: index.php");
        exit();
    }else{
        $usernamesql    = "SELECT * FROM users where username='$username'";
        $result = $conn->query($usernamesql);
        if ($result->num_rows > 0) {
            $passsql    = "SELECT * FROM users where username='$username' AND password='$password'";
            $presult = $conn->query($passsql);
            if ($presult->num_rows > 0) {
                $row        	=   $presult->fetch_object();
                $fname      	=   $row->first_name;
                $lname      	=   $row->last_name;
                $user_id    	=   $row->id;
                $user_type		=   $row->user_type;
                $project_id		=   $row->project_id;
                $warehouse_id	=   $row->warehouse_id;
				
                $username		=   $row->username;
                $store_id		=   $row->store_id;
                $employee_id	=   $row->employee_id;
                $role			=   $row->role;
                unset($_SESSION['error']);
                $_SESSION['success']                =   $fname.' '.$lname." have successfully loggedin!";
                $_SESSION['logged']['user_name']    =   $fname.' '.$lname;
                $_SESSION['logged']['user_id']      =   $user_id;
                $_SESSION['logged']['user_type']	=   $user_type;
                $_SESSION['logged']['project_id']	=   $project_id;
                $_SESSION['logged']['warehouse_id']	=   $warehouse_id;
				
                $_SESSION['logged']['username']		=   $username;
                $_SESSION['logged']['store_id']		=   $store_id;
                $_SESSION['logged']['employee_id']	=   $employee_id;
                $_SESSION['logged']['role']			=   $role;

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
            $_SESSION['error_message']['username_valid']    =   'Invalid username';
            $_SESSION['error']                           =   "Login credential was not correct.";
            header("location: index.php");
            exit();
        }
    }
}