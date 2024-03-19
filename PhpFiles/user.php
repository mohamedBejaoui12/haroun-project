<?php
include "connect.php";

// Pagination variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 9;
$offset = ($page - 1) * $limit;

// SQL query with pagination
$sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmt = $con->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

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
    <style>
        body {
            background-color: #f9f9f9;
        }
        .header {
            background-color: #fff;
            padding: 5px;
            text-align: center;
            position: sticky;
            top: 0;
            right: 0;
            z-index: 999;
        }
        .input-group{
            margin: auto;
            width: 500px;
            z-index: 999;
        }
        .hero {
            background-image: url('flower-background.jpg');
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
            max-width: 100%;
            height: 100%;
            object-fit: contain;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
        a:hover {
            text-decoration: none;
            color: inherit;
        }
        .card{
            transition: .3s ease-in-out;
        }
        .card:hover{
            transform: scale(1.1);
        }
        .btn{
            background-color: #f34f3f;
            color: white;
            transition: all .3s ease;
        }
        .btn:hover{
            background-color: #f34e3fd5;
            color: white;
        }
        .page-link{
            text-decoration: none;
            color: inherit;
        }
        .page-item.active .page-link {
            background-color: #f34f3f;
            border-color: #f34f3f;
        }
        .f{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
        }
        input{
            width: 50%
        }
        .search{
            width: 160px;
        }
        #basic-addon1{
            text-align: center;
            background-color: #f34f3f;
            width: 50px;
            color: white;
            font-size: 20px;
        }
        .container{
            margin-top: 30px;
        }
        /* Sidebar Styles */
        .sidebar {
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
            <div class="userName">Person's Name</div>
            <div class="userEmail">person@gmail.com</div>
        </div>
    </div>
</div>
<hr>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="#">Link 1</a>
            </li>
            <li class="list-group-item">
                <a href="#">Link 2</a>
            </li>
            <li class="list-group-item">
                <a href="#">Link 3</a>
            </li>
            <li class="list-group-item">
                <a href="#">Link 4</a>
            </li>
            <li class="list-group-item">
                <a href="#">Link 5</a>
            </li>
            <li class="list-group-item logout">
                <a href="#">Log out <span><i class="fa-solid fa-right-from-bracket"></i></span></a>
            </li>
            
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <nav class="navbar bg-body-tertiary">
                <form class="container-fluid">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
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
        <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>

        </nav>
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

