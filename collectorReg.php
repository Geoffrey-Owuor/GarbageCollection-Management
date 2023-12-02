<?php
  session_start();

  include("connection.php");
  include("functions.php");
  $user_data = admin_login($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	//Posted something
	$collector_name = $_POST['collector_name'];
	$password = $_POST['password'];
	$collector_email = $_POST['collector_email'];

	if(!empty($collector_name) && !empty($password) && !empty($collector_email) && !is_numeric($collector_name))
	{
		//save to database
		$collector_id = random_num(7);
		$query = "insert into collectors(collector_id, collector_name ,password,collector_email) values ('$collector_id','$collector_name','$password','$collector_email')";
		mysqli_query($con,$query);

		header("Location: admin.php#greaterReg");
		die;
	}else
	{
		header("Location: collectorReg.php?error=Please enter valid information");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Collector Registration</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Collector Registration</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<input type="text" class="field" placeholder="Enter collector username" name="collector_name" id="collector_name" required>
                <input type="email" class="field" placeholder="Enter collector email" name="collector_email" id="collector_email" required>
               <!-- <input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<input type="password" class="field" placeholder="Enter collector password" name="password" id="password" required>
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<!--<textarea placeholder="More details about your session" class="field"></textarea>-->
				<input class="btn" type="submit" value="Register">
			 </form>
			 <br><br>			 
             <a class="btn" href="admin.php">homepage</a>
			</div>
		</div>
	</div>
</body>
</html>