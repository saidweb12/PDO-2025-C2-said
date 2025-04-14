<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil | laissez-nous un message</title>
</head>
<body>
<h1>Accueil</h1>
<h2>Laissez-nous un message</h2>
<form action="" method="post">
    <label for="name">Nom</label>
    <input type="text" name="name" id="name" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="message">Message</label>
    <textarea name="message" id="message" rows="10" required></textarea>
    <button type="submit">Envoyer</button>
</form>
<h2><?=$h2?></h2>
<div class="messages">
    <?php
    if ($messages !== "aucun"):
        ?>
        <h3>nom</h3>
        <p>Message</p>
        <p>Date</p>
        <?php
        foreach ($messages as $message): 
            ?>
            <h3><?= htmlspecialchars($message["name"]) ?></h3>
            <p><?= htmlspecialchars($message["message"]) ?></p>
            <p><?= htmlspecialchars($message["created_at"]) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    
        <div class="nomessages"> 
            <h2>IL y a X message(s)</h2> 
        </div>
  

    <h3>nom</h3>
    <p>Message</p>
    <p>Date</p>
</div>
<?php
 var_dump ($_POST, );
?> 
</body>
</html>
