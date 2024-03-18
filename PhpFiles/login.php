<?php
include 'connect.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
    $stm = $con->prepare($sql);
    $stm->bindParam(':email', $email, PDO::PARAM_STR);
    $stm->bindParam(':password', $password, PDO::PARAM_STR);
    $stm->execute();
    $res = $stm->fetchAll();
    $count = count($res);
    if ($count === 1) {
        header('Location: user.php');
        exit;
    } else {
        echo '<div class="alert alert-danger text-center mt-3">incorrect data! Please try again.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            background-color:#f34f3f ;
        }
        /* Center the card horizontally */
        .card {
            width: 550px;
            padding: 10px;
          
        }
        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        h4{
    color: #f34f3f;
    font-weight: bold;
    text-align: left;
    font-size: 30px;
}
    </style>
</head>
<body>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title ">Login</h4>
                        <form method="post" action="login.php">
                            <div class="mt-4 mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="mt-4 mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3 mb-3" style="background-color:#f34f3f;border:none;" name="login">Login</button>
                            <p>havn't an account? <a class="link" href="addUser.php">Register</a></p>
                        </form>
        </div>
    </div>
</body>
</html>
