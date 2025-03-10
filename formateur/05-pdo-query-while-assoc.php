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
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}

// requête avec un PDO::query(), $request contient les résultats, qui ne sont pas encore formaté pour PHP
$request = $db->query("SELECT * FROM `theuser`;");

// on récupère les champs 'idthearticle', 'thearticletitle' et 'thearticledate' lorsque la date est supérieure à '2020-01-01 20:43:30'
$requestTheArticle = $db->query("
        SELECT `thearticle`.`idthearticle`, `thearticle`.`thearticletitle`, `thearticle`.`thearticledate`
            FROM `thearticle`
        WHERE
            `thearticle`.`thearticledate` > '2020-01-01 20:43:30' ;   ");

// on souhaite avoir les résultats uniquement en tableau associatif
$request->setFetchMode(PDO::FETCH_ASSOC);

// déconnexion (on a déjà récupéré les résultats)
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
<h1>PDO::query</h1>
<p>PDO::query — Prépare et Exécute une requête SQL sans marque substitutive (non préparée), est généralement utilisée pour les "SELECT" sans entrée d'utilisateur</p>
<h2>Affichage avec while (à éviter pour la suite)</h2>
<p>On utilise $request->setFetchMode(PDO::FETCH_ASSOC); pour n'obtenir qu'un tableau associatif</p>
<p>En utilisant while avec la méthode PDO::fetch, qui permet normalement de ne récupérer qu'une ligne, on liste ligne par ligne les résultats. </p>
<?php
while($item = $request->fetch()){

    // tableau numérique
    echo $item['idtheuser']." ".$item['theuserlogin']." ".$item['theusername']."<hr>";
}

// bonne pratique, effacement des données
$request->closeCursor();
?>
<h2>Affichage avec while et fetch</h2>
<p>On fait le choix de PDO::FETCH_OBJ directement dans le fetch</p>
<?php
while ($item = $requestTheArticle->fetch(PDO::FETCH_OBJ)):
?>
<p>Id : <?=$item->idthearticle ." | Title : ".$item->thearticletitle?> | Date : <?=$item->thearticledate?></p>
<?php
endwhile;
?>
<p></p>
</body>
</html>
