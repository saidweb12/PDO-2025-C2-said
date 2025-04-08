<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>20 derniers articles</title>
</head>
<body>
<h1>20 derniers articles</h1>
<p>Affichez ici les 20 derniers articles (si possible avec le nom de l'auteur) en utilisant un foreach</p>
<?php
// tant qu'on a des articles
foreach($articles as $article){
?>
    <h3><?=cutTitle($article['thearticletitle'])?></h3>
    <h4>Ecrit par <?=$article['theusername']?> le <?=$article['thearticledate']?></h4>
    <p><?=$article['thearticletext']?></p>
<?php
}
// var_dump($db,$request,$countArticles,$articles,);
var_dump($articles[0]);
?>
</body>
</html>