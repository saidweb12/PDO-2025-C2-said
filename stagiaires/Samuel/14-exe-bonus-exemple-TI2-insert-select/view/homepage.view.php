<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Accueil | laissez-nous un message</title>
</head>
<body>
<h1>Accueil</h1>
<h2>Laissez-nous un message</h2>
<?php
// si on a bien envoyé un message
if(isset($success)):
?>
    <h4 class="success"><?=$success?></h4>
<?php
endif;
// si on a une erreur lors de l'insertion
if(isset($error)):
?>
<h4 class="error"><?=$error?></h4>
<?php
    endif; ?>
<form action="" method="post">
    <label for="surname">Nom</label>
    <input type="text" name="surname" id="surname" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="message">Message</label>
    <textarea name="message" id="message" rows="10" required></textarea>
    <button type="submit">Envoyer</button>
</form>
<hr>
<?php
// si on a pas de message (tableau vide)
if(empty($messages)):
?>

<div class="nocommentary">
    <h2>Il n'y a pas de commentaire</h2>
    <p>Veuillez revenir sur cette page plus tard</p>
</div>

<?php
// le tableau n'est pas vide
else:
    // On ajoute une variable pour le 's' de commentaire si nécéssaire
    $commentarys = $nbCommentary>1 ? "s" : "";
?>

<div class="commentary">
    <h2>Il y a <?=$nbCommentary?> commentaire<?=$commentarys?></h2> 
    <?php
    echo "<hr>$pagination";
    // tant qu'on a des messages
    foreach ($messages as $message):
    ?>
    <h3><?=$message['surname']?></h3>
    <p><?=$message['message']?></p>
    <p><?=$message['create_date']?></p>
    <hr>
    <?php
    endforeach;

    ?>

</div>
<?php
// fin du if
endif;
echo "$pagination<hr>";

?>
</body>
</html>
