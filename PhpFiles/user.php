<?php
include "connect.php";
$sql = "SELECT * FROM products";
$stmt=$con->prepare($sql);
$stmt->execute();
$resault=$stmt->fetchAll() ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f9f9f9;
    }
    .header {
        background-color: #fff;
        padding: 20px;
        text-align: center;
    }
    .hero {
        background-image: url('flower-background.jpg'); /* Replace with your image */
        background-size: cover;
        color: #fff;
        padding: 100px 0;
        text-align: center;
    }
    .hero h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }
    .hero p {
        font-size: 18px;
    }
    .personImg {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }
    .personImg img {
        transform: scale(1.3);
        max-width: 100%; /* Ensure images don't exceed container width */
        height: 100%; /* Maintain aspect ratio */
        object-fit: contain;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
    a:hover {
        text-decoration: none; /* Remove underline on hover */
        color: inherit; /* Inherit color from parent */
    }
</style>

</head>
<body>
    <div class="header">
        <h1>Flower Shop</h1>
        <p>Your one-stop destination for beautiful flowers</p>
    </div>
    <div class="container">
    <div class="row">
    <?php 
        if($resault){
            foreach($resault as $row){
                $imageData = base64_encode($row["image"]); // Convert BLOB data to base64
                $src = 'data:image/jpeg;base64,'.$imageData; // Create image source with base64 data
                echo '<a class="col-md-4" href="description.php?id='. $row['id'] .'">
                        <div class="card mb-4">
                            <div class="personImg">
                                <img src="'. $src .'" class="card-img-top" alt="product image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">' . $row['name'] . '</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><b>' . $row['price'] . '</b> DT</h6>
                                <button class="btn btn-danger">Add to Cart</button>
                            </div>
                    </div>
                </a>';
            }
        }
    ?>
    </div>
</div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
