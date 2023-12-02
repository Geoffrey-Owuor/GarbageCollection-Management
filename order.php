<?php 
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
  //Posted something
  $phone_number = $_POST['phone_number'];
  $location = $_POST['location'];
  $house_address = $_POST['house_address'];
  $collection_date = $_POST['collection_date'];
  if(!empty($phone_number) && !empty($location) && !empty($house_address) && !empty($collection_date) && !is_numeric($location))
  {
	  //read from database
      $id = $_SESSION['user_id'];
      $status = "pending";
	  $query = "insert into orders(phone_number, location, user_id, house_address, collection_date,status) VALUES('$phone_number','$location','$id','$house_address','$collection_date','$status')";
	  mysqli_query($con,$query);
      if($location === "Tigoni"){
        header("Location: payment.php?error=Collection for Tigoni is Kshs.350");
	    exit();
      }else if($location === "Kabuku"){
        header("Location: payment.php?error= Collection for Kabuku is Kshs.200");
	    exit();
      }else if($location === "Ngecha"){
        header("Location: payment.php?error= Collection for Ngecha is Kshs.300");
	    exit();
      }
  }else
  {
	  header("Location: payment.php?error=Invalid Location name");
	  exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="order.css">
	
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">               
               <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong>Insert</strong>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Order for your garbage collection</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                                <label for="">Location</label>
                                <select name="location" id="location" class="field">
                                    <option value="">select location</option>
                                    <option value="Ngecha" selected>Ngecha</option>
                                    <option value="Kabuku">Kabuku</option>
                                    <option value="Tigoni">Tigoni</option>
                                </select>
							<div class="form-group mb-3"> 
                                <label for="">House Address</label>
                                <input type="text" name="house_address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Collection Date & Time</label>
                                <input type="datetime-local" name="collection_date" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime" class="btn btn-primary">Order</button>
                            </div>
							
							<a href="user.php" class="btn btn-primary">HOME</a>
							
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
