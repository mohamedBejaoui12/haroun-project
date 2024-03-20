<?php
include "connect.php";
session_start();

if(empty($_SESSION['login'])){
    header('location:login.php');
}

$userID= $_SESSION['id'];
$sql2="SELECT * FROM user WHERE id=$userID";
$stm=$con->prepare($sql2);
$stm->execute();
$userData=$stm->fetch();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $sql = "SELECT * FROM products WHERE name LIKE :search LIMIT :limit OFFSET :offset";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    // Hide pagination links
    $hidePagination = true;
} else {
    $sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    // Show pagination links
    $hidePagination = false;
}

$total_pages = ceil($con->query("SELECT COUNT(*) FROM products")->fetchColumn() / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./userStyle.css">
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
                <a href="#" >All Products</a>
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

    <div class="main-content">
        <div class="header">
            <nav class="navbar bg-body-tertiary">
                <form class="container-fluid" method="POST">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1" name="search">
                    </div>
                </form>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <?php 
                if($result){
                    foreach($result as $row){
                        $imageData = base64_encode($row["image"]);
                        $src = 'data:image/jpeg;base64,'.$imageData;
                        echo '<a class="col-md-4" href="description.php?id='. $row['id'] .'">
                                <div class="card mb-4">
                                    <div class="personImg">
                                        <img src="'. $src .'" class="card-img-top" alt="product image">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">' . $row['name'] . '</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><b>' . $row['price'] . '</b> DT</h6>
                                        <button class="btn">Add to Cart</button>
                                    </div>
                                </div>
                            </a>';
                    }
                }
                ?>
            </div>
        </div>
        <?php if(!$hidePagination): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
