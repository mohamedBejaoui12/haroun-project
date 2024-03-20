<?php
include 'connect.php';
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
    exit(); 
}
else{
    $userId = $_SESSION['id'];
    $sql = "SELECT cart.quantity, cart.adding_date, products.name, products.image FROM cart INNER JOIN products ON cart.idProduct = products.id WHERE cart.idUser = ?";
    $stm = $con->prepare($sql);
    $stm->execute([$userId]);
    $cartItems = $stm->fetchAll();
    $sql3 = "SELECT * FROM user WHERE id = $userId"; // Update query variable name
    $stm3 = $con->prepare($sql3);
    $stm3->execute();
    $userData = $stm3->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./userStyle.css">
    <style>
        section{
            width: 70%;
            margin: auto;
        }
        /* Custom styling */
        .product-info {
            display: flex;
            align-items: center;
        }
        .product-info img {
            max-width: 100px; /* Adjust based on your needs */
            margin-right: 15px; /* Space between image and text */
        }
        .product-details {
            flex-grow: 1;
        }
    </style>
</head>

<body>

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
        <ul class="list-group ">
            <li class="list-group-item">
                <a href="user.php">All Products</a>
            </li>
            <li class="list-group-item activeN">
                <a href="#">Newest Products</a>
            </li>
            <li class="list-group-item">
                <a href="#">My cart</a>
            </li>
            <li class="list-group-item">
                <a href="profile.php">Profile</a>
            </li>
            <li class="list-group-item logout">
                <a href="logout.php">Log out <span><i class="fa-solid fa-right-from-bracket"></i></span></a>
            </li>
            
        </ul>
    </div>
    <section>
        <h1>Cart</h1>
        <ul class="list-group">
            <?php foreach($cartItems as $item): ?>
            <li class="list-group-item">
                <div class="product-info">
                    <?php
                    // Rendering image from binary data
                    $imageData = $item['image'];
                    $imageType = 'image/jpeg'; // Change to match your image type if necessary
                    $base64 = base64_encode($imageData);
                    $imageSrc = "data:$imageType;base64,$base64";
                    ?>
                    <img src="<?php echo $imageSrc; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="product-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p class="product-price">Quantity = <?php echo $item['quantity']; ?></p>
                        <p class="payment-date">Added to cart: <?php echo $item['adding_date']; ?></p>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</body>

</html>
