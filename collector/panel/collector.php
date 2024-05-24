<?php
 session_start();

 include("../../connection/connection.php");
 include("../../functions/functions.php");
 $user_data = collector_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collector Dashboard</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
    <div class="logo"></div>
    <ul>
     <li><a href="#"><i class="fas fa-qrcode"></i>Dashboard</a></li>
     <li><a href="#pending"><i class="fa-solid fa-trash-can"></i>Orders</a></li>
     <li><a href="#theTrucks"><i class="fa-solid fa-truck"></i>Trucks</a></li>
     <li><a href="../logout/collectorLogout.php"><i class="fas fa-sign-out-alt"></i>Log Out </a> </li>   
    </ul>    
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span><h3>Hello!</h3></span>
                <h2><?php echo $user_data['collector_name']; ?></h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                <!--<i class="fa-solid fa-search"></i> -->
                <!--<input type="text" placeholder="Search"> -->
                </div>
                <img src="../../css/img/img.jpeg" alt="">
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">
                Collector Information
            </h3>
            <div class="table-container">
                <table>
                 <tbody>
                 <tr>
                        <th>Collector Id</th>
                        <?php 
                        $id= $_SESSION['collector_id'];
                        $sql = "SELECT collector_id FROM collectors where collector_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["collector_id"]. "</td>";
                        }
                        ?>
                    </tr>      
                 <tr>
                        <th>Collector Name</th>
                        <?php 
                        $id= $_SESSION['collector_id'];
                        $sql = "SELECT collector_name FROM collectors where collector_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["collector_name"]. "</td>";
                        }
                        ?>
                    </tr>
                    
                    <tr>
                        <th>Collector Email</th>
                        <?php 
                        $id= $_SESSION['collector_id'];
                        $sql = "SELECT collector_email FROM collectors where collector_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["collector_email"]. "</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <th id="the-profiler">Password</th>
                        <?php 
                        $id= $_SESSION['collector_id'];
                        $sql = "SELECT password FROM collectors where collector_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["password"]. "</td>";
                        }
                        ?>
                    </tr>
                     <tr>
                        <th>Action</th> 
                        <td class="password-change"><a href="../change_password/Cchange_password.php">Edit Password</a></td>
                     </tr>   
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="tabular--wrapper" id="pending">
            <h3 class="main--title">
                Pending Orders
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th>Phone Number</th>
                        <th>Location</th>
                        <th>House Address</th>
                        <th>Collection Date</th>
                        <th>Status</th>
                        <th>Confirm Collection</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id = $_SESSION['collector_id'];
                        $sql = "SELECT id, user_id, phone_number, location, house_address, collection_date, collection_status FROM orders where status='assigned' and collector_id='$id' and collection_status='pending'";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["id"]. "</td>
                                <td>".$row["user_id"]. "</td>
                                <td>".$row["phone_number"]. "</td>
                                <td>".$row["location"]. "</td>
                                <td>".$row["house_address"]. "</td>
                                <td>".$row["collection_date"]. "</td>
                                <td class='the-status'><a href='#'>".$row["collection_status"]. "</a></td>
                                <td class='the-delete'><a href='../confirm_collection/confirm1.php?id=".$row['id']."'>Confirm</a></td>
                                </tr>";
                        }
                        ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="snow">
            <h3 class="main--title">
                Collected Orders
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th>Phone Number</th>
                        <th>Location</th>
                        <th>House Address</th>
                        <th>Collection Date</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id = $_SESSION['collector_id'];
                        $sql = "SELECT id, user_id, phone_number, location, house_address, collection_date, collection_status FROM orders where status='assigned' and collector_id='$id' and collection_status='collected'";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["id"]. "</td>
                                <td>".$row["user_id"]. "</td>
                                <td>".$row["phone_number"]. "</td>
                                <td>".$row["location"]. "</td>
                                <td>".$row["house_address"]. "</td>
                                <td>".$row["collection_date"]. "</td>
                                <td class='the-status1'><a href='#'>".$row["collection_status"]. "</a></td>
                                
                                </tr>";
                        }
                        ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="theTrucks">
            <h3 class="main--title">
                Your Assigned Trucks
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Vehicle Id</th>
                        <th>Collector Id</th>
                        <th>License Id</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id= $_SESSION['collector_id'];
                        $sql = "SELECT vehicle_id, collector_id, license_id FROM trucks where collector_id='$id'";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["vehicle_id"]. "</td>
                                <td>".$row["collector_id"]. "</td>
                                <td>".$row["license_id"]. "</td>
                                </tr>";
                        }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</body>
</html>