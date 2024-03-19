<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" >Admin</a>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="ajouter_etudiant.php">Ajouter Etudiant</a>
        <a class="nav-link" href="ajouter_enseignant.php">Ajouter Enseignant</a>
        <a class="nav-link" href="ajouter_soutenance.php">Ajouter Soutenance</a>
        <a class="nav-link" href="liste_etudiants.php">Liste Etudiants</a>
        <a class="nav-link" href="rechercher.php">Recherch</a>
        <a class="nav-link" href="logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
</nav>
<div class="container">
        <h1 class="mt-5 text-center">Bienvenue dans le Système de Gestion des Stages</h1>

        <p class="lead text-center">
            Ceci est un système simple de gestion des étudiants, enseignants et soutenances 
            <br>
            vous pouvez ajouter, supprimer, mettre à jour et visualiser des informations sur les étudiants.
        </p>
    </div>

    
</body>
</html>