<?php
 $host = 'localhost'; 
 $dbname = 'stages'; 
 $username = 'root'; 
 $password = ''; 
try
{
	$connect = new PDO('mysql:host='.$host.';dbname='.$dbname,$username, $password); 
}
catch(PDOException $e) 
{ 
    echo 'Erreur : '.$e->getMessage().'<br />'; 
    echo 'N° : '.$e->getCode(); 
}
?>