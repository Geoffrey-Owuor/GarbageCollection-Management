
<?php
/*$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "envneat";

if(!$con = mysqli_connect($dbhost, $dbuser,$dbpass, $dbname))
{
    die("Failed to connect!");
}
*/

$con = new mysqli("localhost","root","","envneat",3306);

// Check connection
if($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
?>