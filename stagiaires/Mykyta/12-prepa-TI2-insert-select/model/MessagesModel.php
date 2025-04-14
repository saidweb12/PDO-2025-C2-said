<?php

//création d'une founction qui va récupérer tous les nos messages

function getAllMessagesOrderByDateDesk(PDO $connection): string|array{
    $prepare = $connection->prepare("SELECT * FROM `messages` ORDER BY `messages`.`created_at` DESC");
    try{
        $prepare->execute();
        $count = $prepare->rowCount();
        if ($count === 0) return "Pas encore de message !";
        return $prepare -> fetchAll();
    } catch (Exception $e){
        die($e->getMessage());
    }
}

function addMessage(PDO $connection, string $name, string $email, string $text):bool{
    try {
        $prepare = $connection->prepare("INSERT INTO `messages` (`name`, `email`, `message`) VALUES (:name, :email, :message)");
        $prepare->bindParam(':name', $name);
        $prepare->bindParam(':email', $email);
        $prepare->bindParam(':message', $text);
        return $prepare->execute();
    } catch (Exception $e) {
        return false;
    }
}