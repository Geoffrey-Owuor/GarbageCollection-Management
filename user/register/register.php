<?php
  session_start();

  include("../../connection/connection.php");
  include("../../functions/functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	//Posted something
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if(!empty($username) && !empty($password) && !empty($email) && !is_numeric($username))
	{
		//save to database
		$user_id = random_num(7);
		$query = "insert into users(user_id, username,password,email) values ('$user_id','$username','$password','$email')";
		mysqli_query($con,$query);

		header("Location:../login/login.php?success=Registration successful, you can login"); 
		die;
	}else
	{
		header("Location:register.php?error=Please enter valid information");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Manager</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Registration Form</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<input type="text" class="field" placeholder="Enter username" name="username" id="username" required>
                <input type="email" class="field" placeholder="Enter Email" name="email" id="email" required>
                <!--<input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<input type="password" class="field" placeholder="Enter password" name="password" id="password" required>
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<!--<textarea placeholder="More details about your session" class="field"></textarea>-->
				<input class="btn" type="submit" value="Register">
			 </form>
			 <br><br>
			 <a class="btn" href="../login/login.php">Login</a>
			 <a class="btn" href="../../index.php">homepage</a>
			</div>
		</div>
	</div>
</body>
</html>