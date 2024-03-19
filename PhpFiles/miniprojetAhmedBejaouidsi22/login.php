<?php
session_start();
include 'connexion.php';
if(isset($_POST['submit'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $sql="select * from administrateur where login='$login' and mot_de_passe='$password'";
    $stm=$connect->prepare($sql);
    $stm->execute();
    if($stm->rowCount()==1){
        $_SESSION['login']=true;
        header('location:index.php');
    }
    else{
        echo '<script type="text/javascript">alert("le login ou le mot de passe n est pas correct");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Log In</title>
</head>
<body>
<div class="container my-5 ">
        <div class="mx-auto" style="width: 300px;">
            <h1 class="mb-4 text-center">Log in</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="login" class="form-label text-start">Login</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-start">Mot De Passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>

</body>
</html>