<?php
 session_start();

 include("connection.php");
 include("functions.php");
 $user_data = admin_login($con);

 if (isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
    $delete = mysqli_query($con, "DELETE FROM users where user_id='$user_id'");
    header("Location: admin.php#the-profiler");
    die;
 }else{
    echo "Could not delete the selected data";
 }

 if (isset($_GET['collector_id'])){
    $collector_id=$_GET['collector_id'];
    $delete = mysqli_query($con, "DELETE FROM collectors where collector_id='$collector_id'");
    header("Location: admin.php#greaterReg");
    die;
 }else{
    echo "Could not delete the selected data";
 }

 if (isset($_GET['vehicle_id'])){
    $vehicle_id=$_GET['vehicle_id'];
    $delete = mysqli_query($con, "DELETE FROM trucks where vehicle_id='$vehicle_id'");
    header("Location: admin.php#theTrucks");
    die;
 }else{
    echo "Could not delete the selected data";
 }
?>
