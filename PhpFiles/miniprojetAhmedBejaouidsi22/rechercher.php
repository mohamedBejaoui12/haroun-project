<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Recherch</title>
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
        <a class="nav-link " href="ajouter_soutenance.php">Ajouter Soutenance</a>
        <a class="nav-link" href="liste_etudiants.php">Liste Etudiants</a>
        <a class="nav-link active" href="rechercher.php">Recherch</a>
        <a class="nav-link" href="logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
</nav>
    <div class="container my-5">
    <table class="table">
        <h3 class="mb-4 text-center  bg-secondary text-white p-1"> Liste des Soutenance de 15/12/2023</h3>
  <thead>
    <tr>
      <th scope="col">Numjury</th>
      <th scope="col">Date Soutenance</th>
      <th scope="col">note</th>
      <th scope="col">Nce</th>
      <th scope="col">Matricule</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query="select * from soutenance where date_soutenance='15/12/2023'";
    $stm=$connect->prepare($query);
    $stm->execute();
    $result=$stm->fetchAll();
    if($result){
        foreach($result as $row){
            echo "<tr>
            <td >".$row['Numjury']."</td>
            <td >".$row['date_soutenance']."</td>
            <td >".$row['note']."</td>
            <td >".$row['Nce']."</td>
            <td>".$row['Matricule']."</td>
          </tr>";
        }
    }

?>
  </tbody>
</table>
</body>
</html>