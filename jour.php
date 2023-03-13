
<?php
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

require 'connexionBDD.php';

$idproduit = 1;
$idcalibre = 1;
$idorigine = 1;
// $req = $bdd->prepare('
// SELECT * 
// FROM ventes, produits, origine, calibre 
// WHERE ventes.idproduit = produits.idproduit 
// AND ventes.idcalibre = calibre.idcalibre 
// AND ventes.idorigine = origine.idorigine 
// AND date = CURRENT_DATE ORDER BY ventes.idproduit, ventes.idorigine, ventes.idcalibre
// ');
$req = $bdd->prepare('
SELECT nom, calibreLegume, pays, modeCulture, quantite, unite
FROM ventes
JOIN produits ON ventes.idproduit = produits.idproduit
JOIN origine ON ventes.idorigine = origine.idorigine
JOIN calibre ON ventes.idcalibre = calibre.idcalibre
JOIN culture ON ventes.idculture = culture.idculture
WHERE date = CURRENT_DATE ORDER BY ventes.idproduit, ventes.idorigine, ventes.idcalibre
');
$req->execute();


$ventes = [];


while ($donnees = $req->fetch())
{
  $legumes = array(
    "Produit"=> $donnees['nom'],
    "Origine"=> $donnees['pays'],
    "Calibre"=> $donnees['calibreLegume'],
    "Culture"=> $donnees['modeCulture'],
    "Quantite"=> $donnees['quantite'],
    "Unite"=> $donnees['unite']
  );
  
  array_push($ventes, $legumes);
}

echo json_encode($ventes);

?>