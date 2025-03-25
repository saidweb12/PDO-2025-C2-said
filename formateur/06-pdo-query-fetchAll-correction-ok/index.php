<?php
# index.php | Contrôleur frontal

// On appelle le fichier config-prod.php (requis une seule fois).
# Copie de config-dev.php sous le nom de config-prod.php
require_once "config-prod.php";# appel de celui-ci 1 fois

// en utilisant un try / catch
try{
    // On se connecte à la DB 'pdo_c2' via PDO
    // en utilisant les constantes de connexion
    // instanciation avec PDO
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
        /*options:[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]*/ // on va attribuer à la connexion la manière de gérer les données par PHP, ici en fetch_assoc
    );
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}

// on effectue une requête où on prend les 20 derniers articles
$sql = "SELECT * FROM thearticle 
         -- WHERE idthearticle = 800
        ORDER BY thearticledate DESC
        LIMIT 20;";
# en cas de soucis SQL non affiché, on peut utiliser aussi un try catch (pas une bonne pratique en production, ok en dev et test)
try {
    # exécution de la requête (SQL peut se trouver dedans)
    $query = $db->query($sql);
}catch(Exception $e){
    die($e->getMessage());
}

# on compte le nombre de lignes de résultats
$nbArticles = $query->rowCount();

# si pas de résultats
if($nbArticles===0){
    // $articles est un string qui contient le message d'erreur
    $articles = "Pas encore d'articles";
# on a au moins un résultat
}else{
    # $articles est tableau indexé
    # contenant des tableaux associatif
    // transformation en tableau associatif (fetchAll)
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);
}





// var_dump($query,$articles);




// fermeture de la requête
$query->closeCursor();
// fermeture de connexion
$db = null;

// appel de la vue
include"accueilView.php";