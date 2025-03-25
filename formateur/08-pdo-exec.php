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

// création de valeurs aléatoires pour l'insertion
$caracteres = '0123456789 abcdefghijkl mnopqrstuv wxyzABCDEFGHI JKLMNOPQR STUVWXYZ';
$nCaracteres = strlen($caracteres); // nombres de caractères
$thearticletitle = '';
for($i=0; $i<25; $i++){
    $thearticletitle .= $caracteres[rand(0, $nCaracteres-1)];
}
$thearticletext = '';
for($i=0; $i<300; $i++){
    $thearticletext .= $caracteres[rand(0, $nCaracteres-1)];
}


// on ajoute un article à la date du jour avec des valeurs au hasard et l'auteur 1
$insertTheArticle = $db->exec("INSERT INTO `thearticle`  (`thearticletitle`, `thearticletext`, `theuser_idtheuser`) VALUES ('$thearticletitle','$thearticletext', '1')");
// on récupère l'id de la dernière ligne insérée
$lastId = $db->lastInsertId();

// on modifie la date des articles dont l'id est entre 495 et 500 pour la date du jour
$updateTheArticle = $db->exec("UPDATE `thearticle` SET `thearticledate` = NOW() WHERE `idthearticle` BETWEEN 495 AND 500");

// fermeture de la connexion
$db = null;


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
<h1>PDO::exec</h1>
<p>PDO::exec — Exécute une requête SQL sans marque substitutive (non préparée), est généralement utilisée pour les "INSERT, DELETE ou UPDATE" sans entrée d'utilisateur</p>
<p>PDO::exec — Exécute une requête SQL et retourne le nombre de lignes affectées par la requête</p>
<p>$lastId = $db->lastInsertId(); permet de récupérer la dernière insertion (avec la connexion qui est celle de l'utilisateur courant)</p>
<h2>Nombre de ligne insérée: <?=$insertTheArticle?>, ID de cette dernière ligne : <?=$lastId?></h2>
<p>Nombre de ligne modifiée: <?=$updateTheArticle?></p>

</body>
</html>