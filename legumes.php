<?php
header("Access-Control-Allow-Origin: *");
// header('Content-type: text/html; charset=UTF-8');
header("Access-Control-Allow-Headers: Content-type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
function debug_to_console($data)
{
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);

  // echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

require 'connexionBDD.php';

$idproduit = 1;
$idcalibre = 1;
$idorigine = 1;
$req = $bdd->prepare('SELECT * FROM ventes 
  WHERE idproduit = :produit 
  AND idorigine = :origine 
  AND idcalibre = :calibre 
  ORDER BY date desc
  ');

$req->execute(array(
  'produit' => $idproduit,
  'calibre' => $idcalibre,
  'origine' => $idorigine
));

$ventes = [];

while ($donnees = $req->fetch())
{
  $legumes = array(
    "Date"=> $donnees['date'],
    "Quantite"=> $donnees['quantite'],
    "Unite"=> $donnees['unite']
  );
  
  array_push($ventes, $legumes);
}

echo json_encode($ventes);
// echo "toto";
?>