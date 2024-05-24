<?php
session_start();

include('../../connection/connection.php');

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
  //Posted something
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(!empty($username) && !empty($password) && !is_numeric($username))
  {
	  //read from database
	  $query = "select * from users where username = '$username' limit 1";
	  $result = mysqli_query($con,$query);
	  if($result)
	  {
		if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['password'] === $password)
			{
				$_SESSION['user_id'] = $user_data['user_id'];
				header("Location:../panel/user.php");
				die;
			}

        }
	  }
	  header("Location:login.php?error=Wrong username or password");
	  exit();
  }else
  {
	  header("Location:login.php?error=Wrong username or password");
	  exit();
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Manager</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Login Form</h2>
			 <form action="" method="post">
				<?php if (isset($_GET['error'])) { ?>
     		  <p class="error"><?php echo $_GET['error']; ?></p>
     	     <?php } ?>

     	    <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<input type="text" class="field" placeholder="Your Username" name="username" id="username" required>
				<input type="password" class="field" placeholder="Your Password" name="password" id="password" required>
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<!--<textarea placeholder="More details about your session" class="field"></textarea>-->
				<input class="btn" type="submit" value="Login">
			 </form>
			 <br><br>
			 <a class="btn" href="../register/register.php">Register</a>
			 <a class="btn" href="../../index.php">homepage</a>
			</div>
		</div>
	</div>
</body>
</html>