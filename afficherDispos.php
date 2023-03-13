<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


require 'connexionBDD.php';

$data = file_get_contents("php://input", true);

$ath = $bdd->prepare('SELECT produits.nom produit, origine.nom origine, calibre.nom calibre, quantite, unite
  FROM ventes
  INNER JOIN produits ON ventes.idproduit = produits.idproduit
  INNER JOIN origine ON ventes.idorigine = origine.idorigine
  INNER JOIN calibre ON ventes.idcalibre = calibre.idcalibre
  WHERE quantite != 0');
$ath->execute();

$ventes = [];

while ($donnees = $ath->fetch())
{
  array_push($ventes, $donnees);
}

echo json_encode($ventes);

?>