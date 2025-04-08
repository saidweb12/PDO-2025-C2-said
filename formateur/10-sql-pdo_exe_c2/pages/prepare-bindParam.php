<?php
// requête préparée avec marqueurs nommés
$sql ="SELECT * 
FROM articles
WHERE id < :id
AND titre LIKE :titre
ORDER BY date_creation DESC;
";

// préparation effective de la requête
$prepare1 = $db->prepare($sql);

// créer les marqueurs avec bindParam
$prepare1->bindParam(":id",$myId,PDO::PARAM_INT);
// PDO::PARAM_STR par défaut
$prepare1->bindParam(":titre",$myTitle);

// on doit remplir nos marqueurs
$myId = 7;
$myTitle = "Article%";

$prepare1->execute();
$affiche1 = $prepare1->fetchAll();

// bonne pratique
$prepare1->closeCursor();

// on modifie nos marqueurs
$myId = 10;
$myTitle = "%titre%";

// effectue la requête avec les nouvelles valeurs !
$prepare1->execute();
$affiche2 = $prepare1->fetchAll();

// bonne pratique
$prepare1->closeCursor();

// var_dump($affiche1,$affiche2);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>prepare et bindParam</title>
</head>
<body>
<?php
include "inc/menu.php";
?>
<h1>PDO et pdo_exe_c2.sql</h1>
<h2>prepare et bindParam</h2>
<h3>Avec marqueurs nommés</h3>
<p>Notre code</p>
<code><pre>
    // requête préparée avec marqueurs nommés
$sql ="SELECT *
FROM articles
WHERE id < :id
AND titre LIKE :titre
ORDER BY date_creation DESC;
";

// préparation effective de la requête
$prepare1 = $db->prepare($sql);

// créer les marqueurs avec bindParam
$prepare1->bindParam(":id",$myId,PDO::PARAM_INT);

// PDO::PARAM_STR par défaut
$prepare1->bindParam(":titre",$myTitle);

// on doit remplir nos marqueurs
$myId = 7;
$myTitle = "Article%";

// exécution de la requête
$prepare1->execute();

// récupération des données (pour SELECT)
$affiche1 = $prepare1->fetchAll();

// bonne pratique
$prepare1->closeCursor();
    </pre></code>
<?php
foreach($affiche1 as $k => $item){
    echo ($k+1).") ID: $item[id] | Titre: $item[titre] | Texte: $item[texte] | Date de création: $item[date_creation]<br>";

}
var_dump($affiche2);
?>
</body>
</html>
