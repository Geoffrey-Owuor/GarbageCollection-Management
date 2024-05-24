<?php
  session_start();

  include("../../connection/connection.php");
  include("../../functions/functions.php");
  $user_data = admin_login($con);

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
	//Posted something
	$vehicle_id = $_POST['vehicle_id'];
	$collector_id = $_POST['collector_id'];
	$license_id = $_POST['license_id'];

	if(!empty($vehicle_id) && !empty($collector_id) && !empty($license_id))
	{
		//save to database
		$query = "insert into trucks(vehicle_id, collector_id ,license_id) values ('$vehicle_id','$collector_id','$license_id')";
		mysqli_query($con,$query);

		header("Location: ../panel/admin.php#theTrucks");
		die;
	}else
	{
		header("Location:addTruck.php?error=Please enter valid information");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Truck</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Add Truck</h2>
			 <form method="post">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				<!--<input type="text" class="field" placeholder="Your user ID" name="user_id" id="user_id" required> -->
				<input type="text" class="field" placeholder="Vehicle Id" name="vehicle_id" id="vehicle_id" required>

					<select name="collector_id" id="collector_id" class="field">
						<option value="" class="optioncolor">Collector Id</option>
					<?php 
					$categories = mysqli_query($con, "select collector_id from collectors");
					while($c = mysqli_fetch_array($categories)){

					 ?>
					 <option value="<?php echo $c['collector_id'] ?>"><?php echo $c['collector_id'] ?></option>
					 <?php } ?>
				</select>
				
               <!-- <input type="text" class="field" placeholder="Enter Address" name="address" id="address" required> -->
				<input type="text" class="field" placeholder="License Id" name="license_id" id="license_id" required>
                <!--<input type="text" class="field" placeholder="Retype password" name="password" id="password" required> -->
				<!--<input type="text" class="field" placeholder="Session(e.g., recording at...)" name="session" id="session" required> -->
				<!--<input type="text" class="field" placeholder="Date(YY-MM-DD)" name="date" id="date" required> -->
				<!--<textarea placeholder="More details about your session" class="field"></textarea>-->
				<input class="btn" type="submit" value="Add">
			 </form>
			 <br><br>			 
             <a class="btn" href="../panel/admin.php">homepage</a>
			</div>
		</div>
	</div>
</body>
</html>