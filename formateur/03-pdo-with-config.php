<?php
# Chargement des constantes de connexion
require_once "config_pdo_c2.php";

# Instanciation de PDO avec gestion des erreurs

// essais
try{
    // instanciation avec PDO
    $db = new PDO(
        dsn:DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        username:DB_CONNECT_USER,
        password:DB_CONNECT_PWD,
        options: [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gestion des erreurs, par défaut depuis PHP 8.0
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // mode de récupération par défaut, ici en tableau associatif
        ]
    );
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}

// déconnexion
$db = null;

echo "si je suis ici, c'est que la connexion a fonctionnée";