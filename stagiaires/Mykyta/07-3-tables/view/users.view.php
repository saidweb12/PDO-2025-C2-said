<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Les utilisateurs</title>
</head>
<body>
<?php
include "inc/menu.inc.view.php";
?>
<h1>Les utilisateurs</h1>
<p>Par ordre login ascendant</p>


<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>
<?php
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>".$user['idtheuser']."</td>";
    echo "<td>".$user['theusername'] ."</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>