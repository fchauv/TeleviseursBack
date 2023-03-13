<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

require 'connexionBDD.php';

$data = json_decode(file_get_contents("php://input", true));
$d = true;
var_dump($data);
//$legume = $data[0];
//$nom = $data[1];
//echo "Ajouté";

// while ($donnees = $req->fetch()) {
//   if($donnees['legume'] == $legume && $donnees['nom'] == $nom) {
//     $d = false;
//   }
// }


if ($d == true) {
  // Si non, on l'ajoute
        $req2 = $bdd->prepare('INSERT INTO '.$data->attribue.'(nom) VALUES (:nom)');
        $req2->bindParam('nom', $data->nom);
        $req2->execute();
        // echo ('ajouté');

}



// echo "toto";
?>