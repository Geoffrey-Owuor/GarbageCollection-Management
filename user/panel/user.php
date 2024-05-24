<?php
 session_start();

 include("../../connection/connection.php");
 include("../../functions/functions.php");
 $user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
    <div class="logo"></div>
    <ul>
     <li><a href="#"><i class="fas fa-qrcode"></i>Dashboard</a></li>
     <li><a href="#the-profiler"><i class="fas fa-user"></i>Profile</a></li>
     <li><a href="../collection_order/order.php"><i class="fa-brands fa-first-order"></i>Order</a></li>
     <li><a href="../user_feedback/feedback.php"><i class="fas fa-comments"></i>Feedback</a></li>
     <li><a href="../logout/userLogout.php"><i class="fas fa-sign-out-alt"></i>Log Out </a> </li>   
    </ul>    
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <span><h3>Hello!</h3></span>
                <h2><?php echo $user_data['username']; ?></h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                <!--<i class="fa-solid fa-search"></i> -->
                <!--<input type="text" placeholder="Search"> -->
                </div>
                <img src="../../css/img/img.jpeg" alt="">
            </div>
        </div>
        <div class="card--container">
            <h3 class="main--title">Putting our users in mind</h3>
            <div class="card--wrapper">
                <div class="payment--card light-red">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Efficient trucks
                            </span>
                            <span class="amount--value">Ready for your order</span>
                        </div>
                        <i class="fa-solid fa-truck icon"></i>
                    </div>
                    <span class="card-detail">
                        There for you
                    </span>
                </div>

                <div class="payment--card light-purple">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Taking your trash
                            </span>
                            <span class="amount--value">Any trash</span>
                        </div>
                        <i class="fa-solid fa-trash-can icon"></i>
                    </div>
                    <span class="card-detail">
                        All trash is trash
                    </span>
                </div>
                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                The collectors
                            </span>
                            <span class="amount--value">On the clock</span>
                        </div>
                        <i class="fa fa-users icon" aria-hidden="true"></i>
                    </div>
                    <span class="card-detail">
                        Time is money
                    </span>
                </div>
                <div class="payment--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                We value
                            </span>
                            <span class="amount--value">Your Feedback</span>
                        </div>
                        <i class="fas fa-comments icon"></i>
                    </div>
                    <span class="card-detail">
                        Talk to us
                    </span>
                </div>
                <div class="payment--card light-red">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                The 24/7
                            </span>
                            <span class="amount--value">Working System</span>
                        </div>
                        <i class="fa-solid fa-clock icon"></i>
                    </div>
                    <span class="card-detail">
                        Order anytime
                    </span>
                </div>
                <div class="payment--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Easy to use
                            </span>
                            <span class="amount--value">Web Interface</span>
                        </div>
                        <i class="fas fa-tools icon"></i>
                    </div>
                    <span class="card-detail">
                        User Friendly
                    </span>
                </div>

            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">
                Order History
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Order Id</th>
                        <th>Collection Date</th>
                        <th>Location</th>
                        <th>House Address</th>
                        <th>Payment Code</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id = $_SESSION['user_id'];
                        $sql = "SELECT id, collection_date, location, house_address, payment_code FROM orders where collection_status='collected' and user_id='$id'";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["id"]. "</td>
                                <td>".$row["collection_date"]. "</td>
                                <td>".$row["location"]. "</td>
                                <td>".$row["house_address"]. "</td>
                                <td>".$row["payment_code"]. "</td>
                                </tr>";
                        }
                        ?>

                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper">
            <h3 class="main--title">
                User Information
            </h3>
            <div class="table-container">
                <table>
                 <tbody>
                 <tr>
                        <th>User Id</th>
                        <?php 
                        $id= $_SESSION['user_id'];
                        $sql = "SELECT user_id FROM users where user_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["user_id"]. "</td>";
                        }
                        ?>
                    </tr>   
                 <tr>
                        <th>Username</th>
                        <?php 
                        $id= $_SESSION['user_id'];
                        $sql = "SELECT username FROM users where user_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["username"]. "</td>";
                        }
                        ?>
                    </tr>
                    
                    <tr>
                        <th>Email</th>
                        <?php 
                        $id= $_SESSION['user_id'];
                        $sql = "SELECT email FROM users where user_id='$id'";
                        $result = $con->query($sql);
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                        while($row = $result->fetch_assoc()){
                            echo "<td>". $row["email"]. "</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <th id="the-profiler">Password</th>
                        <?php 
                        $id= $_SESSION['user_id'];
                        $sql = "SELECT password FROM users where user_id='$id'";
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
                        <td class="password-change"><a href="../change_password/change_password.php">Edit Password</a></td>
                     </tr>   
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tabular--wrapper" id="feedbacks12">
            <h3 class="main--title">
               Your Feedbacks
            </h3>
            <div class="table-container">
                <table>
                    <thead>
                        <th>Feedback</th>
                        <th>Reply</th>
                    </thead>
                    <tbody>
                        <?php 
                        $id = $_SESSION['user_id'];
                        $sql = "SELECT info, reply FROM feedback where user_id='$id'";
                        $result = $con->query($sql);
                    
                        if(!$result){
                            die("Invalid query: ". $con->error);
                        }
                    
                        //READ DATA OF EACH ROW
                        while($row = $result->fetch_assoc()){
                            echo 
                                "<tr>
                                <td>".$row["info"]. "</td>
                                <td>".$row["reply"]. "</td>                
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