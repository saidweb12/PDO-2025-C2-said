<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Toutes les rubriques</title>
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>
<h1>Toutes les rubriques</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Titre</th>
        <th>Description</th>
    </tr>
    <?php
    foreach($sections as $item){
        echo "<tr>";
        echo "<td>".$item['idthesection']."</td>";
        echo "<td>".$item['thesectiontitle']."</td>";
        echo "<td>".$item['thesectiondesc']."</td>";
        echo "</tr>";
    }
    ?></table>



</body>
</html>