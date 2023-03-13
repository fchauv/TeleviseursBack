<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


require 'connexionBDD.php';

$data = file_get_contents("php://input", true);

$ath = $bdd->prepare('SELECT nom FROM '.$data);
$ath->execute();

$produits = [];

while ($donnees = $ath->fetch())
{
  array_push($produits, $donnees);
}

echo json_encode($produits);

?>