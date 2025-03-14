<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil de notre site</title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>

<h1>Accueil de notre site</h1>
<p>Bienvenue sur notre site !</p>
<p>Les 3 autres pages vont afficher du contenu d'une base de donnée, chacune affectant une table</p>
<p class="avt_img">Faites un css perso et changez-moi cette photo</p>

<div class="image-container">
    <div class="arrow">Approche toi de la photo ⮕</div>
    <div class="image">
        <img src="img/mikhawa.png" alt="mikhawa" />
        <div class="reveal">
            <img src="../public/img/php_lord.png" alt="PHP Lord" />
            <div class="php-lord">PHP Lord</div>
        </div>
    </div>
</div>

</body>
</html>