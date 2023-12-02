<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "envneat";

if(!$con = mysqli_connect($dbhost, $dbuser,$dbpass, $dbname))
{
    die("Failed to connect!");
}