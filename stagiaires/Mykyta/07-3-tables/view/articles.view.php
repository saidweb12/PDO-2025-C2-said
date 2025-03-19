<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Nos 30 derniers articles</title>
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>
<h1>Nos 30 derniers articles</h1>
<p>Par date DESC</p>

<table>
    <tr>
        <th>Id</th>
        <th>Titre</th>
        <th>Date</th>
    </tr>
    <?php
    foreach($articles as $item){
        echo "<tr>";
        echo "<td>".$item['id']."</td>";
        echo "<td>".$item['title']."</td>";
        echo "<td>".$item['date']."</td>";
        echo "</tr>";
    }
    ?></table>
</body>
</html>