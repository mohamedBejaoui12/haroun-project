<?php
include 'connect.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $resault=$stmt->fetch() ; 
    $imageData = base64_encode($resault["image"]); // Convert BLOB data to base64
    $src = 'data:image/jpeg;base64,'.$imageData;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./description.css">
</head>
<body>
<header class="nav_bar">
      <h1 class="logo"><span class="orange">flowers</span>Sell</h1>
      <ul>
        <li><a class="active" href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Cart</a></li>
        <li><a href="#">Settings</a></li>
      </ul>
    </header>
    
<section >
    <div class="img_container">
    <img src=<?php echo $src ?> alt="flower img"/>
    </div>
    <div class="text_container">
        <h1><?php echo $resault['name']; ?></h1>
        <h3>Price : <?php echo $resault['price']; ?>DT</h3>
        <p><?php echo $resault['description']; ?></p>
        <div class="button_div">
            <button>Add to card</button>
        </div>
    </div>
</section>
</body>
</html>