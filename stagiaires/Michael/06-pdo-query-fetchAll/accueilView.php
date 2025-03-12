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

<?php
// pas d'articles
if(is_string($articles)):
?>
<p><?=$articles?></p>
<?php
// on a au moins 1 article
else:
    ?>
    <h1><?=$nbArticles?> derniers articles</h1>
    <?php
    foreach($articles as $article):
?>
<h3><?=$article['thearticletitle']?> <small>Ecrit le <?=$article['thearticledate']?> par ...</small></h3>
<p><?=$article['thearticletext']?></p>
<hr>
<?php
    endforeach;

endif;
?>
</body>
</html>