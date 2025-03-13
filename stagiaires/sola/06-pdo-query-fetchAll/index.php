// Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).

// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// en utilisant un try / catch

<?php
# Chargement des constantes de connexion
require_once "config-prod.php";

# Instanciation de PDO avec gestion des erreurs

try{
    // instanciation avec PDO
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );
    // on va attribuer à la connexion la manière de gérer les données par PHP
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    echo $e->getCode();
    echo $e->getMessage();

    die($e->getMessage());
}



// on récupère les champs 'idthearticle', 'thearticletitle' et 'thearticledate' lorsque la date est supérieure à '2020-01-01 20:43:30'
$requestTheArticle = $db->query("
        SELECT * FROM `thearticle` ORDER BY `thearticledate` DESC LIMIT 20");
// récupération de toutes les données au format tableau indexé (fetchAll) contenant des tableaux associatifs ($db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);)
$resultTheArticle = $requestTheArticle->fetchAll();

// bonne pratique
$requestTheArticle->closeCursor();

// déconnexion (on a déjà récupéré les résultats)
$db = null;
include"accueilView.php";
?>

// on effectue une requête où on prend les 20 derniers articles
// par `thearticle`.`thearticledate` descendant avec query()

// transformation en tableau associatif (fetchAll)

// fermeture de la requête
// fermeture de connexion

// ppel de la vue