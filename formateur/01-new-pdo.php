<?php

# PDO est une classe qui permet d'instancier (créer) un objet de type PDO

# $myBDD est un pointeur, un lien (drapeau, flag, etc...) vers l'instance (donc objet), et non pas une variable contenant la connexion. On l'appelle aussi l'instance de PDO.
$myBDD = new PDO(
    # dsn -> paramètres de connexion à la DB pdo_c2
    'mysql:host=localhost;dbname=pdo_c2;port=3306;charset=utf8', 
    # username -> login
    'root', 
    #password -> password
    '',
    # options (null ou tableau d'options)

);

$a = 5;
$b = $a; 
$a++; echo '$a a son espace propre : '."$a, et ".'$b également : '.$b;

// ceci n'est pas un clonage, mais la création d'un alias ou d'un lien symbolique vers la connexion !
$myBDD2 = $myBDD;

$myBDD3 = new PDO(
    # dsn -> paramètres de connexion à la DB pdo_c2
    'mysql:host=localhost;dbname=pdo_c2;port=3306;charset=utf8',
    # username -> login
    'root', 
    #password -> password
    '',
    # options (null ou tableau d'options)

);

var_dump($myBDD,$myBDD2,$myBDD3);

// déconnexion, supprime en réalité le lien en MySQL et MariaDB
$myBDD = null;

// seul $myBDD est déconnecté, $myBDD2 est toujours connecté
var_dump($myBDD,$myBDD2,$myBDD3);

try{
    // instanciation d'une connexion PDO
    $db = new PDO(
    # dsn → paramètres de connexion à la DB pdo_c2
        'mysql:host=localhost;dbname=pdo_c2;port=3306;charset=utf8',
        # username -> login
        'root',
        #password -> password
        '',
    # options (null ou tableau d'options)
    );

// on capture l'erreur de type PDOException
// bonne pratique : utiliser plutôt Exception $e
}catch (PDOException $pdoe){
    // arrêt du script avec die()
    // et affichage de l'erreur
    die("Code Erreur PDO 
    : {$pdoe->getCode()}<br>
    Message de l'erreur {$pdoe->getMessage()}");
}

var_dump($db);

//$db = null;

require_once "config_pdo_c2.php";

try{

    $db2 = new PDO(

    // paramètres de connexion à la DB
        DB_CONNECT_TYPE.
        ":host=".DB_CONNECT_HOST.
        ";port=".DB_CONNECT_PORT.
        ";dbname=".DB_CONNECT_NAME.
        ";charset=".DB_CONNECT_CHARSET
        ,
        // login
        DB_CONNECT_USER,

        // mot passe
        DB_CONNECT_PWD,

        // options (tableau associatif) non obligatoire
        // peut être remplacé par des setAttribute
        // https://www.php.net/manual/fr/pdo.setattribute.php
        // sauf pour la connexion permanente
        // qui devrait être déclarée dans ce tableau
        // (voir le pdf)
        [
            // activation des erreurs (inutile depuis 7.4)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // on va définir le fetch mode en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );

// si erreur : $e = new Exception(...)
}catch (Exception $e){
    // arrêt du script avec affichage de l'erreur
    die($e->getMessage());
}

var_dump($db2);