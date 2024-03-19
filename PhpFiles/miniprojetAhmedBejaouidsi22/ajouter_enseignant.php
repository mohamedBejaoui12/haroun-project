<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
include 'connexion.php';
if(isset($_POST['submit'])){
    $mat=$_POST['mat'];
    $nom_ens=$_POST['nom_ens'];
    $prenom_ens=$_POST['prenom_ens'];
    $sql="insert into Enseignant values ($mat,'$nom_ens','$prenom_ens')";
    $stm=$connect->prepare($sql);
    $stm->execute();
    if($stm){
        echo '<script type="text/javascript">alert("Data inserted successfully");</script>';

    }else{
        echo '<script type="text/javascript">alert("Data does not inserted ");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ajouter Enseignant</title>
</head>

<body>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" >Admin</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link "  href="index.php">Home</a>
        <a class="nav-link" href="ajouter_etudiant.php">Ajouter Etudiant</a>
        <a class="nav-link active" href="ajouter_enseignant.php">Ajouter Enseignant</a>
        <a class="nav-link" href="ajouter_soutenance.php">Ajouter Soutenance</a>
        <a class="nav-link" href="liste_etudiants.php">Liste Etudiants</a>
        <a class="nav-link" href="rechercher.php">Recherch</a>
        <a class="nav-link" href="logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
</nav>
    <div class="container my-5">
    <h1 class="mb-4 text-center">Ajouter Enseignant</h1>
        <form method="post">
            <div class="mb-3">
                <label>Matricule Enseignant</label>
                <input type="number" class="form-control" name="mat" required>
            </div>
            <div class="mb-3">
                <label>Nom Enseignant</label>
                <input type="text" class="form-control" name="nom_ens" required>
            </div>
            <div class="mb-3">
                <label>Prenom Enseignant</label>
                <input type="text" class="form-control" name="prenom_ens" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>