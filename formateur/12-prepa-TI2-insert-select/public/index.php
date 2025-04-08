<?php
# public/index.php

/*
 * Contrôleur frontal
 */

# chargement des constantes de connexion en mode prod
require_once "../config.php";
# chargement du modèle (fonctions)
require_once "../model/MessagesModel.php";

# connexion à PDO
try{
    // nouvelle instance de PDO
    $db = new PDO(DB_DSN, DB_CONNECT_USER, DB_CONNECT_PWD,
        // tableau d'options
        [
            // par défaut les résultats sont en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Afficher les exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
}catch(Exception $e){
    // arrêt du script et affichage du code erreur, et du message
    die("Code : {$e->getCode()} <br> Message : {$e->getMessage()}");
}

# ici notre code de traitement de la page

// si on a envoyé le formulaire avec les bons champs
if(isset($_POST['name'],$_POST['email'],$_POST['message'])){
    // traîtement des champs

    # on retire les balises html
    $name = strip_tags($_POST['name']);
    # encodage des caractères dangereux en html (' et " compris)
    $name = htmlspecialchars($name,ENT_QUOTES);
    # on retire les espaces vides avant et après la variable
    $name = trim($name);

    # traitement d'un mail
    $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);

    # protection message
    $message = trim(htmlspecialchars(strip_tags($_POST['message']),ENT_QUOTES));

    // vérification ultime avant d'appeler l'insertion
    if(!empty($name) && $email !== false && !empty($message)){
        // insertion dans la DB
        $insert = addMessage($db,$name,$email,$message);
        // si on a des erreurs depuis le modèle
        if(is_string($insert)){
            $error = $insert;
        }

    }else{
        // création d'une erreur
        $error = "Certains champs ne sont pas valides";
    }
}

// on veut récupérer tous les messages de la table `messages`
$allMessages = getAllMessagesOrderByDateDesc($db);

// si c'est une chaîne de caractère, nous n'avons pas de résultats
if(is_string($allMessages)){
    // nous allons afficher dans la vue
    $h2 = $allMessages;
    $messages = "aucun";
// c'est un tableau indexé
}else{
    // on compte le nombre de ligne(s)
    $countMessages = count($allMessages);
    // si on a un seul message
    $h2 = ($countMessages===1)
        ? "Il y a 1 message"
        : "Il y a $countMessages messages";
    $messages = $allMessages;
}





# chargement de la vue
require_once "../view/homepage.view.php";

# bonne pratique
# fermeture de connexion
$db = null;