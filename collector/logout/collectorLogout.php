<?php

session_start();
if(isset($_SESSION['collector_id']))
{
    unset($_SESSION['collector_id']);
}

header("Location:../index.php");
die;