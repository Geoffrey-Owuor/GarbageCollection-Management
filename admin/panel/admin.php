<?php
 session_start();

 include("../../connection/connection.php");
 include("../../functions/functions.php"); 
 $user_data = admin_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li><a href="#the-profiler"><i class="fa-solid fa-clipboard-user"></i>Users</a></li>
            <li><a href="#theTrucks"><i class="fa-solid fa-truck"></i>Trucks</a></li>
            <li><a href="#unassigned"><i class="fa-solid fa-trash-can"></i>Orders</a></li>
            <li><a href="#greaterReg"><i class="fas fa-users"></i>Collectors</a></li>
            <li><a href="#feedbacks"><i class="fas fa-comments"></i>Feedbacks</a></li>
            <li><a href="../logout/adminLogout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a> 
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span><h3>Hello!</h3></span>
                <h2><?php echo $user_data['admin_name']; ?></h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                </div>
                <img src="../../css/img/img.jpeg" alt="Profile Image">
            </div>
        </div>

        <div class="tabular--wrapper">
            <h3 class="main--title">
                Admin Information
            </h3>
            <div class="table-container">
                <table>
                 <tbody>
                    <tr>
                        <th>Admin Id</th>
                        <?php 
                        $id= $_SESSION['admin_id'];
                        $sql = "SELECT admin_id FROM admin where admin_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["admin_id"]. "</td>";
                        }
                        ?>
                    </tr>   
                    <tr>
                        <th>Admin Name</th>
                        <?php 
                        $id= $_SESSION['admin_id'];
                        $sql = "SELECT admin_name FROM admin where admin_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["admin_name"]. "</td>";
                        }
                        ?>
                    </tr>
                    
                    <tr>
                        <th>Admin Email</th>
                        <?php 
                        $id= $_SESSION['admin_id'];
                        $sql = "SELECT admin_email FROM admin where admin_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["admin_email"]. "</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <th id="the-profiler">Password</th>
                        <?php 
                        $id= $_SESSION['admin_id'];
                        $sql = "SELECT password FROM admin where admin_id='$id'";
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
                        <th>Password Change</th> 
                        <td class='password-change'><a href="../change_password/Achange_password.php">Edit Password</a></td>
                     </tr>   
                     <tr>
                        <th>New Admin</th>
                        <td class='password-change'><a href="../registration/adminReg.php">New Admin</a></td>
                     </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="tabular--wrapper" id="the-profiler">
            <h3 class="main--title">
                Users
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>User Id</th>
                        <th>username</th>
                        <th>email</th>
                        <th>date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT user_id, username, email,date FROM users";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["user_id"]. "</td>
                                <td>".$row["username"]. "</td>
                                <td>".$row["email"]. "</td>
                                <td>".$row["date"]. "</td>
                                <td class='the-delete'><a href='../../functions/delete_function/delete1.php?user_id=".$row['user_id']."'>Delete</a></td>
                                </tr>";
                        }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="theTrucks">
            <h3 class="main--title">
                Trucks
            </h3>
            <br>
            <div>
                <a class="collectorstyle" href="../add_truck/addTruck.php">Add Truck</a>
            </div>
            <br>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Vehicle Id</th>
                        <th>Collector Id</th>
                        <th>License Id</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT vehicle_id, collector_id, license_id FROM trucks";
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
                                <td class='the-delete'><a href='../../functions/delete_function/delete1.php?vehicle_id=".$row['vehicle_id']."'>Delete</a></td>
                                </tr>";
                        }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="unassigned">
            <h3 class="main--title">
                Unassigned Orders
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order id</th>
                        <th>House Address</th>
                        <th>User Id</th>
                        <th>Payment Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT id, house_address, user_id, payment_code, status FROM orders where status='pending' ";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["id"]. "</td>
                                <td>".$row["house_address"]. "</td>
                                <td>".$row["user_id"]. "</td>
                                <td>".$row["payment_code"]. "</td>
                                <td class='the-status'><a href='#'>".$row["status"]. "</a></td>
                                <td class='the-delete'><a href='../assign_order/assign.php?id=".$row['id']."'>Assign</a></td>
                                </tr>";
                        }
                        ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="stark">
            <h3 class="main--title">
                Assigned Orders
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order Id</th>
                        <th>User Id</th>
                        <th>Collector Id</th>
                        <th>Vehicle Id</th>
                        <th>Status</th>
                        <th>Collection Date</th>
                    </thead>
                    <tbody>
                        <?php 
                       $sql = "SELECT id, user_id, collector_id, vehicle_id, status, collection_date FROM orders where status='assigned' and collection_status='pending'";
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
                                <td>".$row["collector_id"]. "</td>
                                <td>".$row["vehicle_id"]. "</td>
                                <td class='the-status1'><a href='#'>".$row["status"]. "</a></td>
                                <td>".$row["collection_date"]. "</td>
                                </tr>";
                        }
                        ?> 

                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">
                Collected Orders
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order id</th>
                        <th>User Id</th>
                        <th>Collector Id</th>
                        <th>Vehicle Id</th>
                        <th>Collection Status</th>
                        <th>Collection Date</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT id, user_id, collector_id, vehicle_id, collection_status, collection_date FROM orders where status='assigned' and collection_status='collected'";
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
                                <td>".$row["collector_id"]. "</td>
                                <td>".$row["vehicle_id"]. "</td>
                                <td class='the-status1'><a href='#'>".$row["collection_status"]. "</a></td>
                                <td>".$row["collection_date"]. "</td>
                                </tr>";
                        }
                        ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="tabular--wrapper" id="greaterReg">
            <h3 class="main--title">
                Collectors
            </h3>
            <br>
            <div>
                <a class="collectorstyle" href="../collector_registration/collectorReg.php">Add Collector</a>
            </div>
            <br>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Collector Name</th>
                        <th>Collector Id</th>
                        <th>Collector Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT collector_name, collector_id, collector_email FROM collectors";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["collector_name"]. "</td>
                                <td>".$row["collector_id"]. "</td>
                                <td>".$row["collector_email"]. "</td>
                                <td class='the-delete'><a href='../../functions/delete_function/delete1.php?collector_id=".$row['collector_id']."'>Delete</a></td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="feedbacks">
            <h3 class="main--title">
               Feedbacks
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>FeedBack Id</th>
                        <th>User Id</th>
                        <th>Email</th>
                        <th>Info</th>
                        <th>status</th>
                        <th>Reply</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT id, user_id, email, info, reply_status, reply FROM feedback";
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
                                <td>".$row["email"]. "</td>
                                <td>".$row["info"]. "</td>
                                <td class='the-status2'><a href='#'>".$row["reply_status"]. "</a></td>
                                <td>".$row["reply"]. "</td>
                                <td class='the-delete'><a href='../feedback_reply/reply.php?id=".$row['id']."'>Reply</a></td>
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