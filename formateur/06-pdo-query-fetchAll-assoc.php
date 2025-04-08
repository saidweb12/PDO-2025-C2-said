<?php
# Chargement des constantes de connexion
require_once "config_pdo_c2.php";

# Instanciation de PDO avec gestion des erreurs

try{
    // instanciation avec PDO
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );
    // on va attribuer à la connexion la manière de gérer les données par PHP
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}


// on récupère les champs 'idthearticle', 'thearticletitle' et 'thearticledate' lorsque la date est supérieure à '2020-01-01 20:43:30'
$requestTheArticle = $db->query("
        SELECT a.`idthearticle` as id,
               a.`thearticletitle` as title,
               a.`thearticledate` as `date` -- alias externes (sortie)
            FROM `thearticle` a -- alias interne (la table)
        WHERE
            a.`thearticledate` > '2020-01-01 20:43:30' ;   ");
// récupération de toutes les données au format tableau indexé (fetchAll) contenant des tableaux associatifs ($db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);)
$resultTheArticle = $requestTheArticle->fetchAll();

// bonne pratique
$requestTheArticle->closeCursor();

// déconnexion (on a déjà récupéré les résultats)
$db = null;

var_dump($resultTheArticle);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO::query</title>
</head>
<body>
<h1>PDO::query</h1>
<p>PDO::query — Prépare et Exécute une requête SQL sans marque substitutive (non préparée), est généralement utilisée pour les "SELECT" sans entrée d'utilisateur</p>
<h2>Affichage avec foreach sur un PDO::fetchall</h2>
<h3>Nous avons <?=$requestTheArticle->rowCount()?> articles depuis début 2020 ($requestTheArticle->rowCount())</h3>
<p>On peut ne pas mettre les guillemets simples pour les tableaux en PHP, ce qui évite une concaténation complèxe. Ne fonctionne pas en OO :
    <code>"$item[id] | $item[title]"</code>, par contre la méthode avec { } fonctionne dans la plupart des cas (<code>"En date de {$item['date']}"</code>)</p>
<h3>PDO::fetchAll</h3>
<p>Dès que l'on suppose que l'on peut avoir plus d'un résultat (autre que 0 ou 1), nous utiliserons le fetchAll()</p>
<?php
// var_dump($resultTheArticle);
// tant qu'on a des résultats
foreach($resultTheArticle as $item):
?>
<h4><?=$item['id']." | $item[title]"?></h4>
<p><?="En date de {$item['date']}"?></p>
<?php
endforeach;
?>
<p></p>
</body>
</html>
