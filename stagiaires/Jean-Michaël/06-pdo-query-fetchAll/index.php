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
require_once "config-prod.php";

try {

    $db = new PDO(
        DB_CONNECT_TYPE . ":host=" . DB_CONNECT_HOST . ";dbname=" . DB_CONNECT_NAME . ";port=" . DB_CONNECT_PORT . ";charset=" . DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {

    die($e->getMessage());
}

$requestTheArticle = $db->query("SELECT * FROM `thearticle` ORDER BY `thearticledate` DESC LIMIT 20 ;");

$resultTheArticle = $requestTheArticle->fetchAll();

$requestTheArticle->closeCursor();

$db = null;

include "accueilView.php";
