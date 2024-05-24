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
// Get the entered truck ID from the form
$vehicle_id = $_POST['vehicle_id'];
$collector_id = $_POST['collector_id'];


	if(!empty($vehicle_id) && !empty($collector_id))
	{
		//save to database
		$status = "assigned";
		$collection_status = "pending";
		$query = "UPDATE orders SET vehicle_id='$vehicle_id', collector_id='$collector_id', status='$status', collection_status='$collection_status' where id='$id'";
		mysqli_query($con,$query);
		
		header("Location:../panel/admin.php#stark");
		die;
	}else
	{
		header("Location:assign.php?error=Please enter valid information");
	    exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Assign Truck</title>
	<link rel="stylesheet" type="text/css" href="../../css/login.css">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Assign Truck</h2>
			 <form  action="" method="POST">
				<?php if (isset($_GET['error'])) { ?>
     		    <p class="error"><?php echo $_GET['error']; ?></p>
     	        <?php } ?>

     	        <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
				
                   <select name="vehicle_id" id="vehicle_id" class="field">
					<option value="" class="optioncolor">Vehicle Id</option>
                    <?php 
					$categories = mysqli_query($con, "select vehicle_id from trucks order by vehicle_id ASC");
					while($c = mysqli_fetch_array($categories)){

					 ?>
					 <option value="<?php echo $c['vehicle_id'] ?>"><?php echo $c['vehicle_id'] ?></option>
					 <?php } ?>
					
				   </select>
                   <select name="collector_id" id="collector_id" class="field">
					<option value="" class="optioncolor">Collector Id</option>
                    <?php 
					$categories = mysqli_query($con, "select collector_id from trucks order by vehicle_id ASC");
					while($c = mysqli_fetch_array($categories)){

					 ?>
					 <option value="<?php echo $c['collector_id'] ?>"><?php echo $c['collector_id'] ?></option>
					 <?php } ?>
					
				   </select>
				
                <input class="btn" type="submit" value="Add">
			 </form>
			 <br><br>			 
             <a class="btn" href="../panel/admin.php">homepage</a>
			</div>
		</div>
	</div>
</body>
</html>