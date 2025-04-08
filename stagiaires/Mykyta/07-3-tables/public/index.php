<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).
require_once "../config-prod.php";
// en utilisant un try / catch
// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// et en activant les erreurs et le fetchAssoc par défaut
try{
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );
    // on va attribuer à la connexion la manière de gérer les données par PHP
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// si erreur, instanciation de 'Exception' avec $e comme pointeur

$request = $db->query("
    SELECT a.`idthearticle` as id,
           a.`thearticledate` as `date`,
           a.`thearticletitle` as `title`
        FROM `thearticle` a
        ORDER BY `thearticledate` DESC
    LIMIT 30;"
);

$articles = $request->fetchAll();

$request->closeCursor();

$userRequest = $db->query("
    SELECT u.`idtheuser`, 
           u.`theusername` 
    FROM `theuser` u ORDER BY u.theuserlogin ASC;
");

$users = $userRequest->fetchAll();

$userRequest->closeCursor();

$section = $db->query("
    SELECT s.`idthesection`, 
           s.`thesectiontitle`,
           s.`thesectiondesc` 
    FROM `thesection` s WHERE 1;");

$sections = $section->fetchAll();
$section->closeCursor();

$db = null;

if (!empty($_GET)) {
    if (isset($_GET['articles'])) {
        include "../view/articles.view.php";
    } elseif (isset($_GET['users'])) {
        include "../view/users.view.php";
    } elseif (isset($_GET['rubriques'])) {
        include "../view/rubriques.view.php";
    } else {
        include "../view/accueil.view.php";
    }
} else {
    include "../view/accueil.view.php";
}

}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}
?>