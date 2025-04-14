<?php
# Contrôleur frontal
require_once "../config-prod.php"; // Appelle le fichier de configuration "config-prod.php" une seule fois
# Appelle le fichier de configuration "config-prod.php" une seule fois

# Utilisation d'un try/catch pour gérer les exceptions
# et connexion à la base de données

try {
  $db = new PDO(DB_CONNECT_TYPE.":host=".";dbname=".DB_CONNECT_NAME.";port=".DB_PORT.";charset".DB_CHARSET,
  DB_CONNECT_NAME,DB_CONNECT_PWD
  //Transformation tableau associatif.
  [


    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,


  ]);
} catch (PDOException $e){
  die($e->getMessage());

}

/*
 * Attention !
 * appel d'un routeur se trouvant dans le dossier `controller`
 * Il fera les requêtes et affichera les résultats dans les vues
 * Regardez accueilView.php comme page par défaut
 */


include "../controller/routeController.php";