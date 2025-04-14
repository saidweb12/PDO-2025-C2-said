<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Exercice</title>
</head>
<body>
<h1>Exercice</h1>
<h2>Laissez-nous un message</h2>
<pre><form id="maPage" method="">
        
<form action="" method="post">
        <label for="surname">Nom</label>
        <input type="text" name="surname" id="name" required>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10" required></textarea>
        <br>
        <button type="submit">Envoyer</button>

    </form>
    <hr>
    <?php
$nombMessage = isset($messages) ? count($messages) : 0;
if ($nombMessage < 1): ?>
    <p>Pas encore de message</p>
<?php elseif ($nombMessage === 1): ?>
    <p>1 message : Il y a <?= $nombMessage ?> message</p>
<?php else: ?>
    <p>Plusieurs messages : Il y a <?= $nombMessage ?> messages</p>
<?php endif; ?>
<hr>
<?php if (!empty($messages)): ?>
    <h2>Nos messages (triés par date DESC)</h2>
    <?php foreach ($messages as $message): ?>
        <div>
            <strong>NOM:</strong> <h3 style="display: inline;"><?= htmlspecialchars($message['surname']) ?></h3><br>
            <strong>TEXTE:</strong> <p style="display: inline;"><?= nl2br(htmlspecialchars($message['message'])) ?></p><br>
            <strong>DATE:</strong> <p style="display: inline;"><?= htmlspecialchars($message['create_date']) ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>