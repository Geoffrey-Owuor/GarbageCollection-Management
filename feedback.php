<?php
  session_start();

  include("connection.php");
  include("functions.php");
  $user_data = check_login($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	//Posted something
	$email = $_POST['email'];
    $info = $_POST['info'];

	if(!empty($email) && !empty($info) && !is_numeric($info))
	{
		//save to database
        $id = $_SESSION['user_id'];
        $reply_status = "pending";
		$query = "insert into feedback(user_id, email, info, reply_status) values ('$id','$email','$info', '$reply_status')";
		mysqli_query($con,$query);

		header("Location: feedback.php?success=Feedback submitted successfully!"); 
		die;
	}else
	{
		header("Location: feedback.php?error=Please enter valid feedback");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>We Value Your Feedback</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<!--<input type="text" class="field" placeholder="Enter username" name="username" id="username" required> -->
                <input type="email" class="field" placeholder="Your Email" name="email" id="email" required>
                <!--<input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<!--<input type="password" class="field" placeholder="Enter password" name="password" id="password" required> -->
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<textarea placeholder="Tell us your feedback" class="field" name="info" id="info" required></textarea>
				<input class="btn" type="submit" value="Submit">
			 </form>
			 <br><br>
			 <a class="btn" href="user.php#feedbacks12">Home</a>
			</div>
		</div>
	</div>
</body>
</html>