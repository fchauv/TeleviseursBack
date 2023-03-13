<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


require 'connexionBDD.php';

$ath = $bdd->prepare('SELECT * FROM calibre');
$ath->execute();

$calibre = [];
$calibres = [];

while ($donnees = $ath->fetch())
{
  array_push($calibres, $donnees);
}

echo json_encode($calibres);

?>