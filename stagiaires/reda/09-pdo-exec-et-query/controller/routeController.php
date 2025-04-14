<?php
// on récupère avec un query le section_title et section_slug pour faire le menu qui sera sur toutes les pages
$menurequest = $db->query("SELECT section_title, section_slug FROM section");
$menu = $menurequest->fetchAll();
$menurequest->closeCursor();

// si la variable $_GET['p'] existe
if(isset($_GET['p'])) {
    if($_GET['p'] == "insert") {

        // requête pour insérer un article au hasard à la date du jour


        // on va inclure le fichier insertView.php
        include "../view/insertView.php";
    } elseif ($_GET['p'] == "update") {
        // requête qui va mettre 3 articles au hasard à la date du jour (article_date_create)


        // on va inclure le fichier updateView.php
        include "../view/updateView.php";
    }
} else {
    // sur l'accueil, on va récupérer les 10 derniers articles publiés par date de création DESC
    $sql = "SELECT a.id , a.title , a.title_slug , a.text, a.article_date_create, u.fullname
            FROM article a
            JOIN user u ON a.user_id = u.id
            WHERE a.published = 1
            ORDER BY a.article_date_create DESC
            LIMIT 10";
    // on va faire une requête avec le PDO
    $requestTheArticle = $db->query($sql);
    // on va récupérer les résultats
    $articles = $requestTheArticle->fetchAll();
    // on va fermer le curseur
    $requestTheArticle->closeCursor();
    // on va fermer la connexion
    $db = null;

    // appel de la vue accueilView.php
    include "../view/accueilView.php";
}