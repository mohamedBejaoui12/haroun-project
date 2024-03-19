<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
include 'connexion.php';
if(isset($_POST['submit'])){
    $numjury=$_POST['numjury'];
    $date=$_POST['date'];
    $note=$_POST['note'];
    $nce=$_POST['nce'];
    $mat=$_POST['mat'];
    $query="insert into soutenance values ($numjury,'$date','$note',$nce,$mat)";
    $stm=$connect->prepare($query);
    $stm->execute();
    if($stm){
        echo '<script type="text/javascript">alert("Data inserted successfully");</script>';
    }else{
      echo '<script type="text/javascript">alert("Data does not  inserted ");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Ajouter Soutenance</title>
</head>

<body>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" >Admin</a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link " href="index.php">Home</a>
        <a class="nav-link" href="ajouter_etudiant.php">Ajouter Etudiant</a>
        <a class="nav-link" href="ajouter_enseignant.php">Ajouter Enseignant</a>
        <a class="nav-link active" href="ajouter_soutenance.php">Ajouter Soutenance</a>
        <a class="nav-link" href="liste_etudiants.php">Liste Etudiants</a>
        <a class="nav-link" href="rechercher.php">Recherch</a>
        <a class="nav-link" href="logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
</nav>
    <div class="container my-5">
    <table class="table">
        <h3 class="mb-4 text-center  bg-secondary text-white p-1"> Liste des noms des enseignant</h3>
  <thead>
    <tr>
      <th scope="col">Matricule</th>
      <th scope="col">Nom Enseignant</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query='select Matricule,nom_ens from enseignant';
    $stm=$connect->prepare($query);
    $stm->execute();
    $result3=$stm->fetchAll();
    if($result3){
        foreach($result3 as  $row){
            echo "<tr>
            <th scope='row'>".$row['Matricule']."</th>
            <td>".$row['nom_ens']."</td>
          </tr>";
        }
    }

?>
  </tbody>
</table>
<table class="table">
        <h3 class="mb-4 text-center  bg-secondary text-white p-1"> Liste des noms des étudiants</h3>
  <thead>
    <tr>
      <th scope="col">NEC</th>
      <th scope="col">Nom Etudiant</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query='select NCE,nom from etudiant';
    $stm=$connect->prepare($query);
    $stm->execute();
    $result2=$stm->fetchAll();
    if($result2){
        foreach($result2 as  $row){
            echo "<tr>
            <th scope='row'>".$row['NCE']."</th>
            <td>".$row['nom']."</td>
          </tr>";
        }
    }

?>
  </tbody>
</table>
<h3 class="mb-4 text-center bg-secondary text-white p-1"> Ajouter Soutenance </h3>
        <form method="post">
            <div class="mb-3">
                <label>Numjury</label>
                <input type="number" class="form-control" name="numjury" required>
            </div>
            <div class="mb-3">
                <label>Date Soutenance</label>
                <input type="text" class="form-control" name="date" required>
            </div>
            <div class="mb-3">
                <label>note</label>
                <input type="number" class="form-control" name="note" step=0.5 required>
            </div>
            <div class="mb-3">
                <label>Numero Carte Etudiant</label>
                <input type="number" class="form-control" name="nce" required>
            </div>
            <div class="mb-3">
                <label>Matriculet</label>
                <input type="number" class="form-control" name="mat" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>