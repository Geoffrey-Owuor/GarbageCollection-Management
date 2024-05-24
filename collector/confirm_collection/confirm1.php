<?php
session_start();

 include("../../connection/connection.php");
 include("../../functions/functions.php");
 $user_data = collector_login($con);

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $delete = mysqli_query($con, "UPDATE orders set collection_status='collected' where id='$id'");
    header("Location:../panel/collector.php#snow");
    die;
 }else{
    echo "Could not confirm the collection";
 }
 ?>