<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Exercice 13</title>
</head>
<body>
<h1>Exercice 13</h1>
<h2>Laissez-nous un message</h2>


<?php if (isset($thanks)):?>
    <h4 class="thanks"><?=$thanks?></h4>
<?php endif; ?>

<?php if (isset($erreur)):?>
    <h4 class="error"><?=$erreur?></h4>
<?php endif; ?>

<form action="" method="post">
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="message">Message</label>
    <textarea name="message" id="message" rows="12" maxlength="600" required style = "resize: none;"></textarea>
    <button type="submit">Envoyer</button>
</form>
<hr>

<?php
if (empty($messages)):
?>
    <div class="nomessage">
        <h2>Pas de message</h2>
        <p>Veuillez consulter cette page plus tard</p>
    </div>
<?php
else:
    $nbMessage = count($messages);
    $pluriel = $nbMessage > 1 ? "s" : "";
?>
    <div class="messages">
        <h2>Il y a <?=$nbMessage?> message<?=$pluriel?></h2>
        <?php foreach ($messages as $message): 
            ?>            
            <h3><?= $message['surname']?></h3>
            <p><?= $message['message']?></p>
            <p><em><?= $message['create_date']?></em></p>
            
        <?php endforeach; ?>
    </div>
<?php
endif; ?>

<hr>
<?php
var_dump($_POST);
?>
<footer>
    <p>Exercice 13 - Prépa TI2</p>
    <p>Mykyta</p>
</body>
</html>
