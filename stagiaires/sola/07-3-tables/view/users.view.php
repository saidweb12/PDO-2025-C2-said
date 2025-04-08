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
    <nav>
        <?php
        include "inc/menu.inc.view.php";
        ?>
    </nav>
    <main>
        <section>
            <div>
                <h1>Les utilisateurs</h1>
                <p>Par ordre login ascendant</p> <br>
                <?php
            foreach ($users as $user):
            ?>
            <h2>
                <?= $user["theuserlogin"] ?>
            </h2>
            <?php
            endforeach;
            ?>
            </div>
        </section>
    </main>
</body>

</html>