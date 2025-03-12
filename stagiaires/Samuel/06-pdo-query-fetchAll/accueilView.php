<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>20 derniers articles</title>
</head>
<body>
<h1>20 derniers articles</h1>
<p>Affichez ici les 20 derniers articles (si possible avec le nom de l'auteur) en utilisant un foreach</p>

<ul>
    <?php foreach ($resultTheArticle as $article) : ?>
        <li>
            <h2><?= $article['thearticletitle'] ?></h2>
            <p>Publié le : <?= $article['thearticledate'] ?></p>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>

