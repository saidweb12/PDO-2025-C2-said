<?php
# fonctions en lien avec la table article
function getAllMessagesOrderByDateDesc(PDO $connection): array
{
    // préparation de la requête
    $prepare = $connection->prepare("
        SELECT * FROM `article`
        ORDER BY `article`.`create_date` DESC
        ");
    // essai / erreur
    try{
        // exécution de la requête
        $prepare->execute();

        // on renvoie le tableau (array) indexé contenant tous les résultats (peut être vide si pas de message).
        return $prepare->fetchAll();

    // en cas d'erreur sql
    }catch (Exception $e){
        // erreur de requête SQL
        die($e->getMessage());
    }

}

function addMessage(PDO $con,string $name, string $email, string $text) : bool|string
{
  $erreur = "";

  $nameVerify = strip_tags($name);
  $nameVerify = htmlspecialchars($nameVerify,ENT_QUOTES);
  $nameVerify = trim($nameVerify);

    if(empty($nameVerify)){
        $erreur.="Votre nom est incorrect.<br>";
    }elseif(strlen($nameVerify)>100){
        $erreur.="Votre nom est trop long.<br>";
    }

$email = filter_var($email,FILTER_VALIDATE_EMAIL);
    if($email===false){
        $erreur .= "Email incorrect.<br>";
    }

    $text = trim(htmlspecialchars(strip_tags($text),ENT_QUOTES));
    if(empty($text)){
        $erreur .= "Message est vide<br>";
    }elseif (strlen($text)>600){
        $erreur .= "Message est trop long !<br>";
    }

    if(!empty($erreur)) return $erreur;

    $prepare = $con->prepare("
        INSERT INTO `article`(`surname`, `email`, `message`) 
        VALUES (?,?,?)
    ");
    try{
        $prepare->execute([$nameVerify,$email,$text]);
        return true;
    }catch (Exception $e){
        die ($e->getMessage());
    }
}