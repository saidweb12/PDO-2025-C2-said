<?php
// Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).

// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// en utilisant un try / catch

// on effectue une requête où on prend les 20 derniers articles
// par `thearticle`.`thearticledate` descendant avec query()

// transformation en tableau associatif (fetchAll)

// fermeture de la requête
// fermeture de connexion

// appel de la vue
include"accueilView.php";
require_once "config_pdo_c2.php";

try{

    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(Exception $e){
    
    die($e->getMessage());
}

// on récupère les champs 'idthearticle', 'thearticletitle' et 'thearticledate' lorsque la date est supérieure à '2020-01-01 20:43:30'
$requestTheArticle = $db->query("SELECT * FROM `thearticle`;");
// récupération de toutes les données au format tableau indexé (fetchAll) contenant des tableaux associatifs ($db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);)
$resultTheArticle = $requestTheArticle->fetchAll();

// bonne pratique
$requestTheArticle->closeCursor();

// déconnexion (on a déjà récupéré les résultats)
$db = null;

?>