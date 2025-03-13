<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).
require_once("config-prod.php");

// appel des dépendances (ici des fonctions utilisateurs)
include("functions.php");

// en utilisant un try / catch,
// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
try{

    $db = new PDO(
        dsn:DB_CONNECT_TYPE.
        ":host=".DB_CONNECT_HOST.
        ";port=".DB_CONNECT_PORT.
        ";dbname=".DB_CONNECT_NAME.
        ";charset=".DB_CONNECT_CHARSET
        , // paramètres de connexion à la DB
        username: DB_CONNECT_USER, // login
        password: DB_CONNECT_PWD, // mot passe
        // options (tableau associatif) non obligatoire
        options:[
            // activation des erreurs (inutile depuis 7.4)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // on va définir le fetch mode en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );

// si erreur => $e = new Exception(...)
}catch (Exception $e){
    // arrêt du script avec affichage de l'erreur
    die($e->getMessage());
}


// on effectue une requête où on prend les 20 derniers articles
// par `thearticle`.`thearticledate` descendant avec query()
/*$request = $db->query("
    SELECT * FROM thearticle 
        ORDER BY thearticledate DESC
    LIMIT 0,20
    ;
");*/
$request = $db->query("
    SELECT a.thearticletitle, a.thearticletext, a.thearticledate,
           u.theusername a
    FROM thearticle a -- alias => thearticle = a
    INNER JOIN theuser u -- alias => theuser = u
        ON u.idtheuser = a.theuser_idtheuser
    -- WHERE 
    ORDER BY a.thearticledate DESC
    LIMIT 0,20
    ;
");


$countArticles = $request->rowCount();

// transformation en tableau indexé (fetchAll)
// contenant les résultats en PDO::FETCH_ASSOC
$articles = $request->fetchAll();

// pour compter le nombre de lignes du tableau echo count($articles);

// fermeture de la requête
$request->closeCursor();
// fermeture de connexion

// appel de la vue (ligne finale)
include"accueilView.php";