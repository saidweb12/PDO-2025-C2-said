# PDO-2025-C2
Connexion PDO - PHP / MySQL, MariaDB, etc ...

## Menu

- [PDO : Présentation](#pdo--présentation)
- [PDO : Installation](#pdo--installation)
- [PDO : liste des SGBD supportés](#pdo--liste-des-sgbd-supportés)
- [PDO : Exemples et exercices](#pdo--exemples-et-exercices)
- [PDO : Fork du dépôt](#pdo--fork-du-dépôt)
- [PDO : Les classes liées à PDO](#pdo--les-classes-liées-à-pdo)
- [PDO : Connexion à la base de données](#pdo--connexion-à-la-base-de-données)
  - [Connexion PDO avec try/catch](#connexion-pdo-avec-trycatch)
    - [Documentation erreurs PDO](#documentation-erreurs-pdo)
    - [Documentation sur les constantes PDO](#documentation-sur-les-constantes-pdo)
  - [Séparation des données sensibles de la connexion](#séparation-des-données-sensibles-de-la-connexion)
  - [Connexion à la base de données complète](#connexion-à-la-base-de-données-complète)
    - [Documentation setAttribute](#documentation-setattribute)
    - [Documentation des connexions permanentes](#documentation-des-connexions-permanentes)
- [PDO : Les méthodes query et exec](#pdo--les-méthodes-query-et-exec)
  - [Méthode `query`](#méthode-query)
    - [Documentation sur `query`](#documentation-sur-query)
    - [Documentation sur le `closeCursor`](#documentation-sur-le-closecursor)
    - [Documentation sur `rowCount`](#documentation-sur-rowcount)
  - [Méthode `exec`](#méthode-exec)
    - [Documentation sur `exec`](#documentation-sur-exec)
    - [Documentation sur `lastInsertId`](#documentation-sur-lastinsertid)
- [PDOStatement : Méthodes `fetch` et `fetchAll`](#pdostatement--méthodes-fetch-et-fetchall)
  - [Méthode `fetch`](#méthode-fetch)
  
    

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

## PDO : liste des SGBD supportés

Voici la liste des pilotes de base de données supportés par PDO :

- `CUBRID` : Pilote CUBRID
- `MS SQL Server` : Pilote Microsoft SQL Server et Sybase
- `Firebird` : Pilote Firebird et Interbase
- `IBM` : Pilote IBM
- `Informix` : Pilote Informix
- `MySQL` : Pilote MySQL et MariaDB
- `Oracle` : Pilote Oracle
- `ODBC` : Pilote ODBC
- `PgSQL` : Pilote PostgreSQL
- `SQLite` : Pilote SQLite 3 et SQLite 2
- `4D` : Pilote 4D
- `FreeTDS` : Pilote FreeTDS/Sybase
- `ODBC et DB2` : Pilote ODBC et DB2 (IBM)
- `ODBC et Firebird` : Pilote ODBC et Firebird
- `ODBC et Informix` : Pilote ODBC et Informix
- ... et bien d'autres

https://www.php.net/manual/fr/pdo.drivers.php


## PDO : Exemples et exercices

Nous mettrons en pratique ce que nous verrons dans la partie théorique. N'oubliez pas de créer un dossier à votre nom dans `stagiaires` et d'y mettre vos fichiers.

Ouvrez PHPMyAdmin, sélectionnez `MySQL` et importez la base de données `pdo_c2.sql` qui se trouve dans le dossier `datas` de ce dépôt.

Vous trouverez les fichiers formateurs dans le dossier `formateur`.

Des exercices progressifs vous y seront proposés.

---

[Retour au menu](#menu)

---

## PDO : Fork du dépôt

Créez un fork de ce dépôt sur Github : 

https://github.com/WebDevCF2m2025/PDO-2025-C2


- **Clonage** de **votre**  fork en local
- On se met dans le projet (cd NomDuProjet) : origin/main existe déjà
- Création de l'**upstream** pour renvoyer le projet via des **pull request** :
`git remote add upstream SSH_KEY`
- **Pull** de la branche **main** de **upstream** pour avoir les dernières modifications : `git pull upstream main`
- Ne travaillez **que dans votre dossier (stagiaires/NomDuStagiaire)**
- Travaillez sur votre branche : `git checkout -b NomDeLaBranche`, pas sur la `main`

---

[Retour au menu](#menu)

---

## PDO : Les classes liées à PDO

Les 3 classes principales de PDO sont :

- `PDO` : classe principale qui permet de se connecter à une base de données.

https://www.php.net/manual/fr/class.pdo.php

- `PDOStatement` : classe qui permet de représenter une requête SQL préparée.

https://www.php.net/manual/fr/class.pdostatement.php

- `PDOException` : classe qui permet de représenter une erreur PDO.

https://www.php.net/manual/fr/class.pdoexception.php

Il existe également la classe `PDORow` qui représente une ligne d'un jeu de résultats retourné par `PDOStatement::fetch()` appelé avec le mode de récupération `PDO_FETCH_LAZY`.

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

Lorsqu'on se connecte en `PDO`, la bonne pratique est de récupérer les éventuelles erreurs grâce aux fonctions `try` et `catch`, et fermeture de la connexion.

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

#### Documentation erreurs PDO

https://www.php.net/manual/fr/pdo.error-handling.php

#### Documentation sur les constantes PDO

https://www.php.net/manual/fr/pdo.constants.php

---

[Retour au menu](#menu)

---

### Séparation des données sensibles de la connexion

Nous allons séparer les données de la connexion, et les rajouter dans un autre fichier. On va les mettre dans des constantes.

Le fichier de production ne sera pas mis sur github, gràce au `.gitignore`.

Création du fichier de configuration de production `config-prod.php` :

```php
<?php
# config-prod.php
# fichier de configuration de PDO en mode production
# données sensibles !
# constantes de connexion à la base de données
# à modifier vers votre environnement de production
# et votre base de données online
const DB_CONNECT_TYPE = "mysql"; // MySQL et MariaDB
const DB_CONNECT_HOST = "localhost";
const DB_CONNECT_PORT = 3306;
const DB_CONNECT_NAME = "pdo_c2";
const DB_CONNECT_CHARSET = "utf8";
const DB_CONNECT_USER = "root";
const DB_CONNECT_PWD = "";
```

On peut en avoir une copie pour le travail en développement `config-dev.php` :

```php
<?php
# config-dev.php
# fichier de configuration de PDO en mode développement.
# Ce fichier peut être sur github car il ne contient pas de données sensibles
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

Pour ce qui est du fichier de connexion de développement, on va inclure le fichier de configuration :

```php
<?php
require_once "config-dev.php";
```

---

[Retour au menu](#menu)

---

### Connexion à la base de données complète

On va inclure le fichier de configuration dans notre fichier de connexion et on va se connecter à la base de données en utilisant les constantes :

```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

try{

    $db = new PDO(
    
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
            // activation des erreurs 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // on va définir le fetch mode en tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );

// on peut modifier un attribut de PDO en utilisant setAttribute également
// ici, on active les erreurs (déjà fait dans le tableau des options)
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// si erreur : $e = new Exception(...)
}catch (Exception $e){
    // arrêt du script avec affichage de l'erreur
    die($e->getMessage());
}

// bonne pratique, fermeture de la connexion
$db = null;
```

#### Documentation setAttribute

https://www.php.net/manual/fr/pdo.setattribute.php

#### Documentation des connexions permanentes

https://www.php.net/manual/fr/pdo.connections.php

```php
<?php
$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
?>
```
    

---

[Retour au menu](#menu)

---

## PDO : Les méthodes query et exec

`query` et `exec` sont des méthodes de la classe `PDO` qui permettent d'exécuter des requêtes SQL non préparées.

Nous utiliserons `query` pour les requêtes `SELECT` et `exec` pour les requêtes `INSERT`, `UPDATE` et `DELETE`, voir des requêtes de gestion des tables et bases de données comme `CREATE`, `DROP`, etc.

Ces méthodes retournent un objet de type `PDOStatement` qui contient les résultats de la requête.

**Nous éviterons de les utiliser** quand il y a des risques d'**injections SQL**, nous verrons plus tard comment les éviter.

---

[Retour au menu](#menu)

---

### Méthode `query`

La méthode `query` permet d'exécuter une requête SQL de type `SELECT` et de récupérer les résultats lorsqu'il y en a. Attention, cette méthode ne permet pas d'exécuter des requêtes préparées.

```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

# connexion voir à "Connexion à la base de données complète"
# ...

    // requête SQL sans entrées de l'utilisateur
    $sql = "SELECT * FROM `table`";

    // Exécution de la requête SQL 
    $query = $db->query($sql);

    // récupération des résultats (tableau associatif),
    // on peut utiliser fetch() pour récupérer un seul résultat
    // Le PDO::FETCH_ASSOC peut déja être défini dans les options de
    // connexion, le fetchAll crée un tableau indexé 
    // contenant des tableaux associatifs comme résultats
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // etc ...

    # bonnes pratiques
    
    // fermeture de la requête
    $query->closeCursor();

    // effacement des résultats (si déjà utilisés)
    $results = null;

    // fermeture de la connexion
    $db = null;

```

---

[Retour au menu](#menu)

---

#### Documentation sur `query`

`PDO::query()` prépare et exécute une requête SQL en un seul appel de fonction, retournant la requête en tant qu'objet PDOStatement.

https://www.php.net/manual/fr/pdo.query.php

---

[Retour au menu](#menu)

---

#### Documentation sur le `closeCursor`

`PDOStatement::closeCursor()` libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.

Ne fonctionne pas avec tous les drivers de base de données, mais reste une bonne pratique.

https://www.php.net/manual/fr/pdostatement.closecursor.php



---

[Retour au menu](#menu)

---

#### Documentation sur `rowCount`

https://www.php.net/manual/fr/pdostatement.rowcount.php

On peut connaitre le nombre de lignes retournées par la requête en utilisant la méthode `rowCount` :

```php
// nombre de lignes retournées
$nbRows = $query->rowCount();
```

---

[Retour au menu](#menu)

---

### Méthode `exec`

La méthode `PDO::exec` permet d'exécuter une requête SQL de type `INSERT`, `UPDATE`, `DELETE`, `CREATE`, `DROP`, etc. Elle retourne le nombre de lignes affectées par la requête.

Attention, cette méthode ne permet pas d'exécuter des requêtes préparées, donc **attention aux injections SQL**.


Exemple avec un `INSERT` :

```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

# connexion voir à "Connexion à la base de données complète"
# ...

    // requête SQL sans entrées de l'utilisateur
    $sql = "INSERT INTO `table` (`col1`, `col2`) VALUES ('val1', 'val2')";

    // Exécution de la requête SQL 
    $nbRows = $db->exec($sql);
    
    // Récupération de l'id de la dernière ligne insérée
    $lastId = $db->lastInsertId();

    // etc ...

    # on peut connaître le nombre de lignes affectées
    # via la variable de retour d'exec
    echo "$nbRows ligne insérée, dernier id : $lastId";

    // fermeture de la connexion
    $db = null;

```

Exemple avec un `UPDATE` :

```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

# connexion voir à "Connexion à la base de données complète"
# ...

    // requête SQL sans entrées de l'utilisateur
    $sql = "UPDATE `table` SET `col1` = 'val1' WHERE `id` > 5 ";

    // Exécution de la requête SQL 
    $nbRows = $db->exec($sql);

    // etc ...

    # on peut connaître le nombre de lignes affectées
    # via la variable de retour d'exec
    echo "Nombre de lignes affectées : $nbRows";

    // fermeture de la connexion
    $db = null;
```

---

[Retour au menu](#menu)

---

#### Documentation sur `exec`

`PDO::exec()` exécute une instruction SQL et retourne le nombre de lignes affectées.

**Nous éviterons de les utiliser** quand il y a des risques d'**injections SQL**, donc des entrées d'un utilisateur, nous verrons plus tard comment les éviter.

https://www.php.net/manual/fr/pdo.exec.php

---

[Retour au menu](#menu)

---

#### Documentation sur `lastInsertId`

`PDO::lastInsertId()` retourne l'identifiant de la dernière ligne insérée ou la valeur d'une séquence, selon la méthode utilisée pour générer la valeur de la colonne.

C'est très utile pour récupérer l'id d'une ligne insérée dans une table avec un auto-increment et de l'utiliser dans une autre table (pour les jointures par exemple).

https://www.php.net/manual/fr/pdo.lastinsertid.php

---

[Retour au menu](#menu)

---

## PDOStatement : Méthodes `fetch` et `fetchAll`

`fetch` et `fetchAll` sont des méthodes de la classe `PDOStatement` qui permettent de récupérer les résultats d'une requête SQL.

`fetch` permet de récupérer une seule ligne de résultat, alors que `fetchAll` permet de récupérer toutes les lignes de résultat.

`fetch` retourne un tableau associatif, un tableau indexé ou un objet selon le mode de récupération défini, alors que `fetchAll` retourne un tableau indexé contenant des tableaux associatifs, des tableaux indexés ou des objets selon le mode de récupération défini.

---

[Retour au menu](#menu)

---

### Méthode `fetch`

La méthode `fetch` permet de récupérer une seule ligne de résultat de la requête SQL. Elle retourne un tableau associatif, un tableau indexé ou un objet selon le mode de récupération défini.

On peut utiliser `fetch` pour récupérer un seul résultat, et `fetchAll` pour récupérer tous les résultats.

L'utilisation du `fetch` avec un `while` permet de parcourir tous les résultats de la requête (donc plusieurs résultats, appréciée par les `IA` et les newbies... cette méthode étant très ancienne), **mais n'est pas une bonne pratique**, nous le verrons dans le dossier cependant dans les premiers fichiers du dossier `formateur`.

```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

# connexion voir à "Connexion à la base de données complète"

# requête SQL sans entrées de l'utilisateur
# on récupère 1 seul résultat, ou 0 si aucun résultat
$sql = "SELECT * FROM `users` WHERE `login` = 'admin'";

$query = $db->query($sql);

// si on a un résultat
if($query->rowCount() > 0){
    // on récupère le résultat sous forme de tableau associatif
    $result = $query->fetch(PDO::FETCH_ASSOC);
}else{
    // sinon, on affiche un message d'erreur
    $result = "Aucun résultat";
}

# bonnes pratiques

// fermeture de la requête
$query->closeCursor();

// fermeture de la connexion
$db = null;

// puis dans la vue (pour le moment le même fichier)
?>
<!doctype html>
<html lang="en">
<!-- ... -->
<?php
// si on a un résultat sous forme de tableau
if(is_array($result)):
?>
<h3>Utilisateur : <?= $result['login'] ?></h3>
<?php
// sinon on affiche le message d'erreur (qui est une chaîne)
else:
 ?>
 <h3><?= $result ?></h3>
 <?php
endif;
 ?>
</body>
</html>
```

---

[Retour au menu](#menu)

---