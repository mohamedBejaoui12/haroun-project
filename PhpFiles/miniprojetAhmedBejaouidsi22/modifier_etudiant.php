<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
include 'connexion.php';
$id=$_GET['updateid'];
$sql1="select * from etudiant where  NCE = $id";
$stm=$connect->prepare($sql1);
$stm->execute();
$row=$stm->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['submit'])){
    $nce=$_POST['nce'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $class=$_POST['class'];
    $sql="update  etudiant set nom='$nom',prenom='$prenom',classe='$class' where NCE = $nce ";
    $stm=$connect->prepare($sql);
    $stm->execute();    
    if($stm){
        echo '<script type="text/javascript">alert("Data updated successfully");</script>';
        header('location:liste_etudiants.php');  
    }else{
        echo '<script type="text/javascript">alert("Data does not  updated ");</script>';
    }
}
if(isset($_POST['annuler'])){
    header('location:liste_etudiants.php');  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ajouter Etudiant</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Numero Carte Etudiant</label>
                <input type="text" class="form-control" name="nce" value=<?php echo $row['NCE'];?> required>
            </div>
            <div class="mb-3">
                <label>Nom Etudiant</label>
                <input type="text" class="form-control" name="nom" value=<?php echo $row['nom'];?> required>
            </div>
            <div class="mb-3">
                <label>Prenom Etudiant</label>
                <input type="text" class="form-control" name="prenom" value=<?php echo $row['prenom'];?> required>
            </div>
            <div class="mb-3">
                <label>Class d'Etudiant</label>
                <input type="text" class="form-control" name="class" value=<?php echo $row['classe'];?> required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">modifier</button>
            <button type="submit" class="btn btn-danger" name="annuler">Annuler</button>
        </form>
    </div>
</body>

</html>