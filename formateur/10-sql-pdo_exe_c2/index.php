<?php

require_once "config-dev.php";

try{
    // nouvelle instance de PDO
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
        // tableau d'options
        [
            // par défaut les résultats sont en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // activation des erreurs
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
}catch (Exception $e){
    die($e->getMessage());
}

// création d'un routeur

// s'il existe la variable get p et qu'elle se trouve dans
// le tableau des pages acceptées (voir PAGE_MENU dans config)
// in_array vérifie si une valeur se trouve dans un tableau
if(isset($_GET['p'])&& in_array($_GET['p'],PAGE_MENU)){
    // on inclut l'url créée du fichier se trouvant dans pages
    include "pages/".$_GET['p'].".php";
}else {
    // appel de l'accueil
    include "pages/homepage.php";
}

// fermeture de la connexion
$db = null;