<?php 
session_start();
include("../../connection/connection.php");
include("../../functions/functions.php");
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
  //Posted something
  $payment_code = $_POST['payment_code'];

  if(!empty($payment_code))
  {
	  //read from database
      $id = $_SESSION['user_id'];
	  $sql = "SELECT MAX(date) as max_date from orders";
	  $result = mysqli_query($con, $sql); 
	  $row = mysqli_fetch_assoc($result);
	  // Retrieve the maximum timestamp
      $maxTimestamp = $row['max_date'];

     // Convert the timestamp to a string
      $maxTimestampString = date("Y-m-d H:i:s", strtotime($maxTimestamp));
    
	  $query = "UPDATE orders SET payment_code='$payment_code' WHERE date='$maxTimestampString' AND user_id='$id'";
	  mysqli_query($con,$query);
      header("Location:payment.php?success=Order is scheduled, your collector will contact you");
	  exit();
      
  }else
  {
	  header("Location:payment.php?error=MPESA QR code unrecognized");
	  exit();
  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment Method</title>
	<link rel="stylesheet" type="text/css" href="../../css/change_password.css">
</head>
<body>
    <form action="" method="post">
     	<h2>Enter MPESA QR Code</h2>
		<h2>Till Number: 5298061</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label>QR Code</label>
     	<input type="text" 
     	       name="payment_code" 
     	       placeholder="Qr Code">
     	       <br>
		<!--<input type="text" 
     	       name="amount" 
     	       placeholder="Amount">
     	       <br> -->

     	<button type="submit">MAKE PAYMENT</button>
          <a href="../panel/user.php" class="ca">HOME</a>
     </form>
</body>
</html>

