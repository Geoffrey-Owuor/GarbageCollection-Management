<?php
  session_start();

  include("../../connection/connection.php");
  include("../../functions/functions.php");
  $user_data = admin_login($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    if (isset($_GET['id'])){
    $id=$_GET['id'];
    }
	//Posted something
    $reply = $_POST['reply'];

	if(!empty($reply) && !is_numeric($reply))
	{
		//save to database
        $reply_status = "replied";
		$query = "UPDATE feedback SET reply='$reply', reply_status='$reply_status' WHERE id='$id'";
		mysqli_query($con,$query);

		header("Location:reply.php?success=Feedback Replied!"); 
		die;
	}else
	{
		header("Location:reply.php?error=Please enter valid reply");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reply</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Feedback Reply</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<!--<input type="text" class="field" placeholder="Enter username" name="username" id="username" required> -->
                <!--<input type="email" class="field" placeholder="Your Email" name="email" id="email" required> -->
                <!--<input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<!--<input type="password" class="field" placeholder="Enter password" name="password" id="password" required> -->
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<textarea placeholder="Feedback Reply" class="field" name="reply" id="reply" required></textarea>
				<input class="btn" type="submit" value="Reply">
			 </form>
			 <br><br>
			 <a class="btn" href="../panel/admin.php#feedbacks">Home</a>
			</div>
		</div>
	</div>
</body>
</html>