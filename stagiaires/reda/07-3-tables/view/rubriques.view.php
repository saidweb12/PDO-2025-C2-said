<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Toutes les rubriques</title>
</head>

<body>
    <?php
    include "inc/menu.inc.view.php";
    ?>
    <h1>Toutes les rubriques</h1>
    <ul>
        <?php foreach ($rubriques as $rubrique) : ?>
            <li>
                <h2>Rubrique : <?= $rubrique['thesectiontitle'] ?></h2>
                <p>Publié par l'id: <?= $rubrique['idthesection'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>