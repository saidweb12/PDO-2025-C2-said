<?php
// création d'un titre unique grâce à microtime(true)
$titre = "Article posté en microsecondes timestamp : ".microtime(true);
// création d'un texte unique
$texte = "Le timestamp est le temps depuis le 01/01/1970 en secondes, ou microsecondes :".microtime();

// insertion dans la DB avec exec
$insert = $db->exec("
    INSERT INTO `articles` (`id`, `titre`, `texte`, `date_creation`) 
    VALUES (NULL, '$titre', '$texte', CURRENT_TIMESTAMP)
");

// $insert contient le nombre de lignes affectées (ici 1)

// on peut récupérer le dernier id inséré par cette connexion (utile pour les multiples insertions).
$insertArticlesId = $db->lastInsertId();

// update de la table articles
$updateArticle = $db->exec("
    UPDATE articles SET date_creation = CURRENT_TIMESTAMP
    WHERE id = 2 OR id = 3;
");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Méthode exec, lastInsertId</title>
</head>
<body>
<?php
include "inc/menu.php";
?>
<h1>PDO et pdo_exe_c2.sql</h1>
<h2>Méthode exec, lastInsertId</h2>
<p>Voici les lignes utilisées Pour l'insertion (INSERT)</p>
<code><pre>
        // insertion dans la DB avec exec
        // $insert contient le nombre de lignes affectées (ici 1)
$insert = $db->exec("
    INSERT INTO `articles` (`id`, `titre`, `texte`, `date_creation`)
        VALUES (NULL, '$titre', '$texte', CURRENT_TIMESTAMP)
");

// on peut récupérer le dernier id inséré par cette connexion
$insertArticlesId = $db->lastInsertId();
    </pre></code>
<p>On affichera dans la vue les variables</p>
<?php
// vues
echo "<h3>Requête 1 avec exec</h3>";
echo "<pre>INSERT INTO `articles` (`id`, `titre`, `texte`, `date_creation`) 
VALUES (NULL, '$titre', 
'$texte', CURRENT_TIMESTAMP)</pre>";
echo "Nombre de ligne affecté : $insert, puis id de ce dernier article inséré : $insertArticlesId ";
echo "<hr>";
?>
<p>Voici les lignes utilisées Pour la mise à jour (UPDATE)</p>
<code><pre>
// update de la table articles
$updateArticle = $db->exec("
    UPDATE articles SET date_creation = CURRENT_TIMESTAMP
    WHERE id = 2 OR id = 3;
");
    </pre></code>

<?php
// vues
echo "<h3>Requête 2 avec exec</h3>";
echo "<pre>UPDATE articles SET date_creation = CURRENT_TIMESTAMP
    WHERE id = 2 OR id = 3;</pre>";
echo "Nombre de lignes affectées : $updateArticle";
echo "<hr>";
?>
</body>
</html>
