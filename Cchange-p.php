<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = collector_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: Cchange_password.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: Cchange_password.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: Cchange_password.php?error=The confirmation password  does not match");
	  exit();
    }else {
        $id = $_SESSION['collector_id'];

        $sql = "SELECT password
                FROM collectors WHERE 
                collector_id='$id' AND password='$op'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE collectors
        	          SET password='$np' 
        	          WHERE collector_id='$id'";
        	mysqli_query($con, $sql_2);
        	header("Location: Cchange_password.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: Cchange_password.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: collector.php");
	exit();
}