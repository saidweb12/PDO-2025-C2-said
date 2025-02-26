<?php

# PDO est une classe qui permet d'instancier (créer) un objet de type PDO

# $myBDD est un pointeur, un lien (drapeau, flag etc...) vers l'instance (donc objet), et non pas une variable contenant la connexion. on l'appel aussi l'instance de PDO.
$myBDD = new PDO(
    # dsn -> paramètres de connexion à la DB pdo_c1
    'mysql:host=localhost;dbname=pdo_c1;port=3306;charset=utf8', 
    # username -> login
    'root', 
    #password -> password
    '',
    # options (null ou tableau d'options)

);

$a = 5;
$b = $a; 
$a++; echo '$a a son espace propre : '."$a, et ".'$b également : '.$b;

// ceci n'est pas un clonage, mais la création d'un alias vers la connexion !
$myBDD2 = $myBDD;

var_dump($myBDD,$myBDD2);