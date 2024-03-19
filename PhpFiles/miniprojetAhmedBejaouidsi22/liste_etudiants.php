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
    <title>Liste Etudiants</title>
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
        <a class="nav-link" href="ajouter_enseignant.php">Ajouter Enseignant</a>
        <a class="nav-link" href="ajouter_soutenance.php">Ajouter Soutenance</a>
        <a class="nav-link active" href="liste_etudiants.php">Liste Etudiants</a>
        <a class="nav-link" href="rechercher.php">Recherch</a>
        <a class="nav-link" href="logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
</nav>
    <div class="container my-5">
    <h1 class="mb-4 text-center">Liste Etudiants</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nce</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    $query='select * from etudiant';
                    $stm=$connect->prepare($query);
                    $stm->execute();
                    $resault=$stm->fetchAll() ;
                    if($resault){
                        foreach($resault as $row){
                            echo "<tr>
                            <td scope='row'>" . $row['NCE'] . "</td>
                            <td>" . $row['nom'] . "</td>
                            <td>" . $row['prenom'] . "</td>
                            <td>" . $row['classe'] . "</td>
                            <td>
                                <a href='supprimer_etudiant.php?deleteid=". $row['NCE'] ."'>
                                    <button class='btn btn-danger'>Supprimer</button>
                                </a>
                                <a href='modifier_etudiant.php?updateid=". $row['NCE'] ."'>
                                <button class='btn btn-primary'>Modifier</button>
                                </a>

                            </td>
                          </tr>";
                    }
                    }
                        
                        
                   


                ?>  
            </tbody>
        </table>
    </div>
</body>

</html>