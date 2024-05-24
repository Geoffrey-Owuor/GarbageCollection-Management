<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id= $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }
    //redirect to login
header("Location: ../user/login/login.php");
die;
}

function admin_login($con)
{
    if(isset($_SESSION['admin_id']))
    {
        $id= $_SESSION['admin_id'];
        $query = "select * from admin where admin_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }
    //redirect to login
header("Location: ../admin/login/adminLogin.php");
die;
}
function collector_login($con)
{
    if(isset($_SESSION['collector_id']))
    {
        $id= $_SESSION['collector_id'];
        $query = "select * from collectors where collector_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }
    //redirect to login
header("Location: ../collector/login/collectorLogin.php");
die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4, $length);

    for($i=0; $i < $len; $i++){
        #code...
        $text .= rand(0,9);
    }

    return $text;
}