<?php
include 'connect.php';
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
    exit(); // Add exit() after header redirect to stop further execution
}
else{
    $userId = $_SESSION['id']; // Change $userID to $userId for consistency
    $sql3 = "SELECT * FROM user WHERE id = $userId"; // Update query variable name
    $stm3 = $con->prepare($sql3);
    $stm3->execute();
    $userData = $stm3->fetch();

    // Correct variable name to $userId
    $userId = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id = $userId"; 
    $stm = $con->prepare($sql);
    $stm->execute();
    $row = $stm->fetch();
    if(isset($_POST['save'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password']; // Correct variable name to $password
        // Update query variable name to $sql2
        $sql2 = "UPDATE user SET firstName='$firstName', lastName='$lastName', email='$email', password='$password' WHERE id = $userId";
        $stm2 = $con->prepare($sql2); // Update prepared statement variable name
        $stm2->execute();
        if($stm2){
            echo '<div class="alert alert-info text-center w-50 m-auto">Updated successfully</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>.sidebar {
            background-color: #f34f3f;
            color: white;
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 50px; /* Adjust this value based on your header height */
        }
        .list-group-item {
            background-color: transparent;
            border: none;
        }
        .list-group-item a {
            color: white;
            font-weight: bold;
            font-size: 18px;
        }
        .list-group-item a:hover {
            text-decoration: none;
            color: #f9f9f9;
        }
        .main-content {
            margin-left: 200px; /* Adjust this value based on your sidebar width */
            padding-top: 20px;
        }
        .sidebar .header{
            background-color: #f34f3f;
            margin-top: -20px;
        }
        .profileImg img{
            width: 40px;
            margin-right: 5px;
        
        }
        hr{
            background-color: white;
            height: 2px;
        }
        .list-group-item.logout {
    position: absolute;
    bottom: 0;
    width: 100%;
   
    
}
.logout a{
    color: #222831;
    transition: all .3s ease;
}
      span i {
        margin-left: 10px;
      }
      .fa-magnifying-glass{
        margin: auto;
      }
      .userName{
            font-size: 18px;
            text-transform: capitalize;}
       .btn{
        background-color: #f34f3f;
        color: white;
        font-size: 15px;
       } 

       .activeN{
        font-size: 20px;
        background-color: #7d140a;

        cursor:default;
       }
       .activeN a{
        cursor:default;
       }
    </style>
</head>
<body>
    <!-- menu -->
    <div class="sidebar">
    <div class="header">
    <div class="row align-items-center">
        <div class="col-md-2">
            <div class="profileImg">
                <img src="../images/profileimg.png" alt="profile img">
            </div>
        </div>
        <div class="col-md-10">
            <div class="userName"><?php echo $userData['firstName']. " " . $userData['lastName'] ; ?></div>
        </div>
    </div>
</div>
<hr>
        <ul class="list-group active">
            <li class="list-group-item">
                <a href="./user.php">All Products</a>
            </li>
            <li class="list-group-item">
                <a href="./neweistProducts.php">Newest Products</a>
            </li>
            <li class="list-group-item">
                <a href="#">My cart</a>
            </li>
            <li class="list-group-item activeN">
                <a href="profile.php" >Profile</a>
            </li>
            <li class="list-group-item logout">
                <a href="logout.php">Log out <span><i class="fa-solid fa-right-from-bracket"></i></span></a>
            </li>
            
        </ul>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Profile</h3>
                        <form method="post" action="profile.php">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value=<?php echo $row['firstName']?>  required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value=<?php echo $row['lastName']?>  required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value=<?php echo $row['email']?>  required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value=<?php echo $row['password']?>  required>
                            </div>                         
                            <button type="submit" class="btn btn-block mt-3" name="save">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
