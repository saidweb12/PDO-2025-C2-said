<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les utilisateurs</title>
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>
<h1>Les utilisateurs</h1>
<p>Par ordre login ascendant</p>
<?php
foreach($users as $user):
?>
<h2><?=$user['theuserlogin']?></h2>
<?php
endforeach;
?>
</body>
</html>