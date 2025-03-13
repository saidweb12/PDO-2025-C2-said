<?php
// chiffre entier au hasard entre 1 et 20
$hasard = mt_rand(1,20);

try{
    // si pair
    if($hasard%2===0){
        $result = $hasard/2;
    }else{
        // création d'une erreur "perso"
        throw new Exception("Les impaires int ($hasard) ne peuvent être divisés sans devenir des float !",9500);
    }

// n'est exécuté qu'en cas d'erreur dans le try
// si erreur équivaut à :
// $e = new Exception('erreur du try');
}catch(Exception $e){
    // arrêt du script et affichage de
    /*
     * Code erreur : 9500
     * Message erreur : Les impaires int (7) ne peuvent être divisés sans devenir des float !
     */
    die("Code erreur : ".$e->getCode()."<br>Message d'erreur : {$e->getMessage()}");
}

echo $result;