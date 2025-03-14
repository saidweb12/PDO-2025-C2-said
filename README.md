# PDO-2025-C2
Connexion PDO - PHP / MySQL, MariaDB, etc ...

## Menu

- [PDO : Présentation](#pdo--présentation)
- [PDO : Installation](#pdo--installation)
- [PDO : Exemples et exercices](#pdo--exemples-et-exercices)
- [Fork du dépôt](#fork-du-dépôt)
- [PDO : Connexion à la base de données](#pdo--connexion-à-la-base-de-données)
  - [Connexion PDO avec try/catch](#connexion-pdo-avec-trycatch)
  - [Séparation des données sensibles de la connexion](#séparation-des-données-sensibles-de-la-connexion)
  - [Les méthodes query et exec](#les-méthodes-query-et-exec)

## PDO : Présentation

`PDO` est l'acronyme de `PHP Data Objects`. C'est une extension PHP qui définit une interface pour accéder à une base de données depuis PHP. 

Cette extension présente l'avantage de supporter de nombreux `SGBD` (`MySQL`, `PostgreSQL`, `Oracle`, etc.) en utilisant une unique interface. 

Cette interface est **orientée objet**, et est une couche d'abstraction qui permet de s'affranchir des spécificités de chaque `SGBD` (système de gestion de base de données).

**PDO** est disponible depuis PHP 5.1.* . Il est recommandé d'utiliser PDO pour accéder à une base de données en `MySQL` ou `MariaDB`. En effet, l'extension `mysql_` est obsolète depuis PHP 5.5.0 et sera supprimée dans une version future de PHP. L'extension `mysqli_` est une alternative `procédurale et/ou orienté objet` à `mysql_`, mais PDO est plus simple à utiliser.

Pour voir les différences entre les extensions `mysqli_` et `PDO`, vous pouvez consulter le [comparatif](https://www.php.net/manual/fr/mysqlinfo.api.choosing.php) sur le site officiel de PHP.

---

[Retour au menu](#menu)

---

## PDO : Installation

PDO est une extension de PHP, il faut donc l'installer et l'activer pour pouvoir l'utiliser. Pour cela, il faut modifier le fichier php.ini de votre serveur. Il faut rechercher la ligne suivante :

```ini
;extension=php_pdo_mysql.dll
```

Et la décommenter en supprimant le point-virgule :

```ini
extension=php_pdo_mysql.dll
```

PDO est généralement installé par défaut avec PHP.

---

[Retour au menu](#menu)

---


## PDO : Exemples et exercices

Nous allons maintenant mettre en pratique ce que nous avons vu dans la partie théorique. N'oubliez pas de créer un dossier à votre nom dans `stagiaires` et d'y mettre vos fichiers.

Ouvrez PHPMyAdmin, sélectionnez `MySQL` et importez la base de données `pdo_c2.sql` qui se trouve dans le dossier `datas` de ce dépôt.

---

[Retour au menu](#menu)

---

## Fork du dépôt

Créez un fork de ce dépôt sur Github : 

https://github.com/WebDevCF2m2025/PDO-2025-C2


- **Clonage** de **votre**  fork en local
- On se met dans le projet (cd NomDuProjet) : origin/main existe déjà
- Création de l'**upstream** pour renvoyer le projet via des **pull request** :
`git remote add upstream SSH_KEY`
- **Pull** de la branche **main** de **upstream** pour avoir les dernières modifications : `git pull upstream main`
- Ne travaillez que dans votre dossier (stagiaires/NomDuStagiaire)
- Travaillez sur votre branche : `git checkout -b NomDeLaBranche`, pas sur la `main`

---

[Retour au menu](#menu)

---

## PDO : Connexion à la base de données

Pour se connecter à une base de données, il faut utiliser la classe `PDO` et lui passer en paramètre les informations de connexion à la base de données. On utilise le mot-clé `new` pour **instancier** un **objet** de la **classe** `PDO` :

```php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 
    'nom_utilisateur', 
    'mot_de_passe'
);

// requête SQL
$sql = "SELECT * FROM `table`";

// Exécution de la requête SQL
$query = $pdo->query($sql);

// récupération des résultats
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// etc ...

// fermeture de la requête
$query->closeCursor();

// effacement des résultats
$results = null;

// fermeture de la connexion
$pdo = null;
``` 

Pour la suite de la partie théorie de ce cours, j'ai créé un .pdf que vous pouvez télécharger [ici](https://github.com/WebDevCF2m2025/PDO-2025-C1/blob/main/datas/PDO-2025.pdf).

---

[Retour au menu](#menu)

---

### Connexion PDO avec try/catch

Lorsqu'on se connecte en PDO, la bonne pratique est de récupérer les éventuelles erreurs grâce aux fonctions `try` et `catch`, et fermeture de la connexion.

https://www.php.net/manual/fr/language.exceptions.php


```php
// essai
try{

// n'est exécuté qu'en cas d'erreur dans le try
// si erreur équivaut à :
// $e = new Exception('erreur du try');
}catch(Exception $e){
    // si on veut afficher le code erreur
    echo $e->getCode();
    // si on veut afficher le message erreur
    echo $e->getMessage();
}
```

On va appliquer ça à notre connexion :

```php

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

// bonne pratique, fermeture de la connexion
$db = null;

```

---

[Retour au menu](#menu)

---

### Séparation des données sensibles de la connexion

Nous allons séparer les données de la connexion, et les rajouter dans un autre fichier. On va les mettre dans des constantes.

Le fichier de production ne sera pas mis sur github, gràce au `.gitignore`.

```php
<?php
# config-prod.php
# fichier de configuration de PDO en mode production
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3306;
const DB_CONNECT_NAME = "pdo_c2";
const DB_CONNECT_CHARSET = "utf8";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";
```

Création du `.gitignore`:

```git
# données sensibles
config-prod.php
```

---

[Retour au menu](#menu)

---

### PDO : Connexion à la base de données complète



---

[Retour au menu](#menu)

---

### Les méthodes query et exec



---

[Retour au menu](#menu)

---