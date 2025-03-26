<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).
require_once("../config-dev.php");

// en utilisant un try / catch
// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// et en activant les erreurs et le fetchAssoc par défaut

try{ 
    $db= new PDO(dsn:DB_CONNECT_TYPE.
        ":host=".DB_CONNECT_HOST.
        ";port=".DB_CONNECT_PORT.
        ";dbname=".DB_CONNECT_NAME.
        ";charset=".DB_CONNECT_CHARSET
        ,username: DB_CONNECT_USER,
        password: DB_CONNECT_PWD,
        options:[
            // activation des erreurs (inutile depuis 7.4)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // on va définir le fetch mode en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
);

}catch (Exception $e){
    // arrêt du script avec affichage de l'erreur
    die($e->getMessage());
}

// suivant l'existence de certaines variables get
if(!empty($_GET)){

    if(isset($_GET["articles"])) {
// effectuez la requête SQL propre à chaque page, puis appelez les vues vers les pages
//modèle
        $queryArticle=$db ->query("SELECT * 
        FROM `thearticle` ORDER BY `thearticle`.`thearticledate` DESC LIMIT 30");
        $articles=$queryArticle -> fetchAll();
            var_dump ($articles);
        //vue
        include "../view/articles.view.php";
    
    }elseif(isset($_GET['users'])){
        $queryUser=$db -> query("SELECT * FROM `theuser` BY the userlogin ASC");
        $users=$queryUser -> fetchAll();
            var_dump($users);
        include "../view/users.view.php"; 


    }elseif(isset($_GET['rubriques'])){
    $queryRubriques=$db -> query("SELECT * FROM `thesection`"); 
    $Rubriques=$queryRubriques -> fetchAll();
        var_dump($Rubriques);
    include "../view/rubriques.view.php";
    }

}else{
    // appel de la vue de l'accueil
    include "../view/accueil.view.php";
}



// fermeture de la requête
$db=null;
// fermeture de connexion