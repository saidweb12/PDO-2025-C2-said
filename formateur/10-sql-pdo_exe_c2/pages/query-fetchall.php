<?php

// on sélectionne tout ce qu'on a dans 'articles'
$request1 = $db->query("SELECT * FROM articles");
// on vérifie si on a récupéré au moins un article
if($request1->rowCount()>0){
    // transformation en tableau indexé
    // On ne connait pas le nombre exact
    $result1 = $request1->fetchAll();
    // variable d'affichage
    $affiche1 = "";
    // boucle tant qu'on a des résultats
    // $k est la cléf et $item la valeur
    foreach($result1 as $k => $item){
        $affiche1 .= ($k+1).") ID: $item[id] | Titre: $item[titre] | Texte: $item[texte] | Date de création: $item[date_creation]<br>";

    }

}else{
    $affiche1 = "1) Pas d'article";
}
// fermeture du curseur
$request1->closeCursor();

// on sélectionne tout ce qu'on a dans 'articles' classé par `date_creation` DESC
$request2 = $db->query("SELECT * FROM articles ORDER BY date_creation DESC");
// on vérifie si on a récupéré au moins un article
if($request2->rowCount()>0){
    // transformation en tableau indexé
    // On ne connait pas le nombre exact
    $result2 = $request2->fetchAll();
    // variable d'affichage
    $affiche2 = "";
    // boucle tant qu'on a des résultats
    // $k est la cléf et $item la valeur
    foreach($result2 as $k => $item){
        $affiche2 .= ($k+1).") ID: $item[id] | Titre: $item[titre] | Texte: $item[texte] | Date de création: $item[date_creation]<br>";

    }

}else{
    $affiche2 = "1) Pas d'article";
}
// fermeture du curseur
$request2->closeCursor();

// on sélectionne tout ce qu'on a dans 'articles' classé par `date_creation` DESC en affichant que les 2 derniers
$request3 = $db->query("SELECT * FROM articles ORDER BY date_creation DESC LIMIT 2");
// on vérifie si on a récupéré au moins un article
if($request3->rowCount()>0){
    // transformation en tableau indexé
    // On ne connait pas le nombre exact
    $result3 = $request3->fetchAll();
    // variable d'affichage
    $affiche3 = "";
    // boucle tant qu'on a des résultats
    // $k est la cléf et $item la valeur
    foreach($result3 as $k => $item){
        $affiche3 .= ($k+1).") ID: $item[id] | Titre: $item[titre] | Texte: $item[texte] | Date de création: $item[date_creation]<br>";

    }

}else{
    $affiche3 = "1) Pas d'article";
}
// fermeture du curseur
$request3->closeCursor();

// on sélectionne les champs id et titre de 'articles' lorsque l'id est supérieure à 2.
$request4 = $db->query("SELECT id, titre FROM articles WHERE id >4");
// on vérifie si on a récupéré au moins un article
if($request4->rowCount()>0){
    // transformation en tableau indexé
    // On ne connait pas le nombre exact
    $result4 = $request4->fetchAll();
    // variable d'affichage
    $affiche4 = "";
    // boucle tant qu'on a des résultats
    // $k est la cléf et $item la valeur
    foreach($result4 as $k => $item){
        $affiche4 .= ($k+1).") ID: $item[id] | Titre: $item[titre]<br>";

    }

}else{
    $affiche4 = "1) Pas d'article";
}
// fermeture du curseur
$request4->closeCursor();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Méthode query, fetchAll et foreach</title>
</head>
<body>
<?php
include "inc/menu.php";
?>
<h1>PDO et pdo_exe_c2.sql</h1>
<h2>Méthode query, fetchAll et foreach</h2>
<p>Voici les lignes utilisées</p>
<code><pre>
    $request1 = $db->query("SELECT ...");

    // on vérifie si on a récupéré au moins un article
    if($request1->rowCount()>0){

    // transformation en tableau indexé
    // On ne connait pas le nombre exact
    $result1 = $request1->fetchAll();

    // variable d'affichage
    $affiche1 = "";

    // boucle tant qu'on a des résultats
    // $k est la cléf et $item la valeur
    foreach($result1 as $k => $item){
        $affiche1 .= ($k+1).") ID: $item[id] | Titre: $item[titre]
        | Texte: $item[texte] | Date de création: $item[date_creation]";

    }

    }else{
        $affiche1 = "1) Pas d'article";
    }

    // fermeture du curseur
    $request1->closeCursor();
    </pre></code>
<p>On affichera dans la vue la variable $affiche1 puis les autres</p>
<?php
// vues
echo "<h3>Requête 1 avec query</h3>";
echo "<pre>SELECT * FROM articles</pre>";
echo $affiche1;
echo "<hr>";
echo "<h3>Requête 2 avec query</h3>";
echo "<pre>SELECT * FROM articles ORDER BY date_creation DESC</pre>";
echo $affiche2;
echo "<hr>";
echo "<h3>Requête 3 avec query</h3>";
echo "<pre>SELECT * FROM articles ORDER BY date_creation DESC LIMIT 2</pre>";
echo $affiche3;
echo "<hr>";
echo "<h3>Requête 4 avec query</h3>";
echo "<pre>SELECT id, titre FROM articles WHERE id >4</pre>";
echo $affiche4;
?>
</body>
</html>
