<?php
session_start();
if(empty($_SESSION['login'])){
    header('location:login.php');
}
    include 'connexion.php';
    if(isset($_GET['deleteid'])){
        $nce=$_GET['deleteid'];
        $sql="delete from etudiant where NCE= $nce";
        $stm=$connect->prepare($sql);
        $stm->execute();
        if($stm){
            header('location:liste_etudiants.php');        
        }
        else{
            echo '<script type="text/javascript">alert("something wrong");</script>';
            header('location:liste_etudiants.php'); 
        }

    }


?>