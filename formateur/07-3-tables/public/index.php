<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).
require_once "../config-prod.php";
// en utilisant un try / catch
try{

    // nouvelle instance
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
        // tableau d'options
        [
            // par défaut les résultats sont en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // affichage des erreurs des requêtes SQL
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// si erreur => $e = new Exception (erreurs du try)
}catch(PDOException $e){
    // arrêt du script et affichage du code erreur, et du message
    die("Code : {$e->getCode()} <br> Message : {$e->getMessage()}");
}
// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// et en activant les erreurs et le fetchAssoc par défaut

// suivant l'existence de certaines variables get
if(isset($_GET['articles'])) {
    // modèle

    $sql = "SELECT a.*, u.theusername
                FROM thearticle a
                INNER JOIN  theuser u
                    ON a.theuser_idtheuser = u.idtheuser
                ORDER BY   a.thearticledate DESC
                LIMIT 30
                
                ";
    // on effectue la requête (allez retour PHP - SQL - PHP)

    $request = $db->query($sql);

    $nbArticles = $request->rowCount();

    // transformation du résultat SQL en format lisible par PHP

    $articles = $request->fetchAll();

    $request->closeCursor();

    // vue
    include "../view/articles.view.php";

}elseif(isset($_GET['rubriques'])) {
    $requestRubriques = $db->query("
    SELECT * FROM thesection;
    ");
    $rubriques = $requestRubriques->fetchAll();
    $requestRubriques->closeCursor();

    include "../view/rubriques.view.php";
}elseif(isset($_GET['users'])) {

    $requestUsers = $db->query(
        "SELECT * FROM theuser ORDER BY theuserlogin ASC"
    );
    $users = $requestUsers->fetchAll();
    $requestUsers->closeCursor();
    include "../view/users.view.php";
}else{
    // appel de la vue de l'accueil
    include "../view/accueil.view.php";
}

// fermeture de connexion
$db =null;