<?php
session_start();

 include("connection.php");
 include("functions.php");
 $user_data = collector_login($con);

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $delete = mysqli_query($con, "UPDATE orders set collection_status='collected' where id='$id'");
    header("Location: collector.php#snow");
    die;
 }else{
    echo "Could not assign the selected data";
 }
 ?>