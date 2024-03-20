<?php
include 'connect.php';
session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result){
        $imageData = base64_encode($result["image"]);
        $src = 'data:image/jpeg;base64,'.$imageData;
    }
}

if(isset($_POST['add'])){
    $input = $_POST['count'];
    $idUser = $_SESSION['id'];
    $sql2 = "INSERT INTO cart (idUser, idProduct, quantity, adding_date) VALUES (:idUser, :id, :input, NOW())";
    $stmt2 = $con->prepare($sql2);
    $stmt2->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->bindParam(':input', $input, PDO::PARAM_INT);
    $stmt2->execute();
    if ($stmt2){
        echo "<script>alert ('Item added to cart successfully :)') </script>";
    } else {
        echo "<script>alert ('Failed to add item to cart!') </script> ";
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
    <style>
        section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: auto;
            width: 90%;
            border-radius: 12px;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }
        .img_container {
            border-radius: 8px;
            width: 30%;
            height: 500px;
            cursor: pointer;
            overflow: hidden;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }
        .img_container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .text_container {
            width: 60%;
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
        .text_container button:hover {
            background-color: #f33c2b;
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
    <section>
        <div class="img_container">
            <img src="<?php echo $src ?>" alt="flower img"/>
        </div>
        <div class="text_container">
            <h1><?php echo $result['name']; ?></h1>
            <h3>Price: <?php echo $result['price']; ?> DT</h3>
            <p><?php echo $result['description']; ?></p>
            <div class="input-group mb-3 cont">
                <form method="post">
                    <input type="number" name="count" class="form-control" value="1">
                    <button class="btn" name="add" type="submit" id="button-addon2">Add to Cart</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
