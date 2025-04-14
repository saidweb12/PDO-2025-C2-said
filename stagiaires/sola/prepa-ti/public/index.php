<?php

require_once "../config.php";

require_once "../model/MessagesModel.php";


try {
    $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    echo $e->getCode();
    echo $e->getMessage();

    die($e->getMessage());
}

# ici notre code de traitement de la page

// si on a envoyé le formulaire avec les bons champs
if(isset($_POST['name'],$_POST['email'],$_POST['message'])){

    // on va tenter l'insertion, car on a protégé addMessage()
    $insert = addMessage($db,$_POST['name'],$_POST['email'],$_POST['message']);

    if($insert===true){
        $thanks = "Merci pour votre nouveau message";
    }else{
        $error = $insert;
    }

}





// on veut récupérer tous les messages de la table `article`
$messages = getAllMessagesOrderByDateDesc($db);



# chargement de la vue
require_once "../view/homepage.view.php";

# bonne pratique
# fermeture de connexion
$db = null;