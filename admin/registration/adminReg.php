<?php
  session_start();

  include("../../connection/connection.php");
  include("../../functions/functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	//Posted something
	$admin_name = $_POST['admin_name'];
	$password = $_POST['password'];
	$admin_email = $_POST['admin_email'];

	if(!empty($admin_name) && !empty($password) && !empty($admin_email) && !is_numeric($admin_name))
	{
		//save to database
		$admin_id = random_num(7);
		$query = "insert into admin(admin_id, admin_name ,password,admin_email) values ('$admin_id','$admin_name','$password','$admin_email')";
		mysqli_query($con,$query);

		header("Location:adminReg.php?success=Registration successful");
		die;
	}else
	{
		header("Location:adminReg.php?error=Please enter valid information");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Admin Registration</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<input type="text" class="field" placeholder="Enter admin username" name="admin_name" id="admin_name" required>
                <input type="email" class="field" placeholder="Enter admin email" name="admin_email" id="admin_email" required>
               <!-- <input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<input type="password" class="field" placeholder="Enter admin password" name="password" id="password" required>
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<!--<textarea placeholder="More details about your session" class="field"></textarea>-->
				<input class="btn" type="submit" value="Register">
			 </form>
			 <br><br>
			 <a class="btn" href="../login/adminLogin.php">Login</a>
			 <a class="btn" href="../panel/admin.php">Home Page</a>
			</div>
		</div>
	</div>
</body>
</html>