<?php
include 'connect.php';
session_start();
$errors = [];
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();

    if(!$result){
        $errors[] = "Product not found.";
    } else {
        $imageData = base64_encode($result["image"]);
        $src = 'data:image/jpeg;base64,'.$imageData;
    }
}

$userID= $_SESSION['id'];
$sql3="SELECT * FROM user WHERE id=$userID";
$stm=$con->prepare($sql3);
$stm->execute();
$userData=$stm->fetch(); 

if(isset($_POST['add'])){
    $input = isset($_POST['count']) ? intval($_POST['count']) : 1;
    $idUser = $_SESSION['id'];
    $sql2 = "INSERT INTO cart (idUser, idProduct, quantity, adding_date) VALUES (:idUser, :id, :input, NOW())";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->bindParam(':input', $input, PDO::PARAM_INT);
    $success = $stmt2->execute();

    if ($success){
        echo "<script>alert('Item added to cart successfully :)')</script>";
        header('location:cart.php');
    } else {
        $errors[] = "Failed to add item to cart!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./userStyle.css">
    <style>
        section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 100px auto;
            width: 70%;
            border-radius: 12px;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            gap: 10px;
        }
        .img_container {
            border-radius: 8px;
            width: 60%;
            height: 500px;
            cursor: pointer;
            overflow: hidden;        }
        .img_container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .text_container h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }
        .text_container h3 {
            font-size: 23px;
            margin: 5px 0px;
        }
        .text_container p {
            font-size: 18px;
            margin: 10px 0px;
        }
        .text_container button {
            background-color: #f34f3f;
            font-size: 16px;
            border: none;
            color: white;
            cursor: pointer;
            transition: all ease .3s;
        }
        .cont {
            width: 200px;
        }
        input {
            text-align: center;
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
            <li class="list-group-item activeN">
                <a href="user.php" >All Products</a>
            </li>
            <li class="list-group-item">
                <a href="./neweistProducts.php">Newest Products</a>
            </li>
            <li class="list-group-item">
                <a href="cart.php">My cart</a>
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
        <div class="img_container">
            <?php if(isset($src)): ?>
                <img src="<?php echo $src ?>" alt="flower img"/>
            <?php endif; ?>
        </div>
        <div class="text_container">
            <?php if(isset($result)): ?>
                <h1><?php echo $result['name']; ?></h1>
                <h3>Price: <?php echo $result['price']; ?> DT</h3>
                <p><?php echo $result['description']; ?></p>
                <div >
                    <form method="post" class="input-group cont">
                        <input type="number" name="count" class="form-control" value="1">
                        <button class="btn" name="add" type="submit" id="button-addon2">Add to Cart</button>
                    </form>
                </div>
            <?php endif; ?>
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
