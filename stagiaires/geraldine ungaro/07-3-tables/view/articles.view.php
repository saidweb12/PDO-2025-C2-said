<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href=".//css/style.css">
    <title>Nos 30 derniers articles</title>
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>
<h1>Nos <?$queryArticle?></h1>

<?php
foreach($articles as $article):
?>
<p>Par date desc</p>
<?= $article['thearticletitle'] ?></li>
<?php
endforeach;
?>

</body>
</html>