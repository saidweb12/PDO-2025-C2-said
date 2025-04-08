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
- [PDOStatement : Méthodes `fetch` et `fetchAll`](#pdostatement--méthodes-fetch-et-fetchall)
  - [Méthode `fetch`](#méthode-fetch)
    - [Documentation sur `fetch`](#documentation-sur-fetch)
  - [Méthode `fetchAll`](#méthode-fetchall)
    - [Documentation sur `fetchAll`](#documentation-sur-fetchall)
- [PDO : Les requêtes préparées](#pdo--les-requêtes-préparées)
  - [Méthode `prepare`](#méthode-prepare)
    - [Documentation sur `prepare`](#documentation-sur-prepare)
  - [Méthode `bindParam`](#méthode-bindparam)
    - [Documentation sur `bindParam`](#documentation-sur-bindparam)
  - [Méthode `bindValue`](#méthode-bindvalue)
    - [Documentation sur `bindValue`](#documentation-sur-bindvalue)
  - [Différence Clé entre `bindParam` et `bindValue`](#différence-clé-entre-bindparam-et-bindvalue)
    - [Avec `bindParam`](#avec-bindparam)
    - [Avec `bindValue`](#avec-bindvalue)
  - [Méthode `execute`](#méthode-execute)
    - [Documentation sur `execute`](#documentation-sur-execute)
  
    

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

---

[Retour au menu](#menu)

---

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

L'utilisation du `fetch` avec un `while` permet de parcourir tous les résultats de la requête (donc plusieurs résultats, appréciée par les `IA` et les newbies... cette méthode étant très ancienne), **mais n'est pas une bonne pratique**, *sauf dans le cas de quantités de données gigantesques, où cette méthode prend moins de mémoire et va un peu plus vite*, nous le verrons dans le dossier cependant dans les premiers fichiers du dossier `formateur`.

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

#### Documentation sur `fetch`

`PDOStatement::fetch()` récupère la ligne suivante d'un jeu de résultats PDOStatement.

https://www.php.net/manual/fr/pdostatement.fetch.php

---

[Retour au menu](#menu)

---

### Méthode `fetchAll`

La méthode `fetchAll` permet de récupérer toutes les lignes de résultat de la requête SQL. Elle retourne un tableau indexé contenant des tableaux associatifs, des tableaux indexés ou des objets selon le mode de récupération défini.


```php
<?php
# index.php

# inclusion du fichier de configuration
require_once "config-dev.php";

# connexion voir à "Connexion à la base de données complète"

# requête SQL sans entrées de l'utilisateur
$sql = "SELECT * FROM `users`";

$query = $db->query($sql);

// si on a des résultats
if($query->rowCount() > 0){
    // on récupère tous les résultats sous forme de tableau associatif
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
}else{
    // sinon, on affiche un message d'erreur
    $results = "Pas encore de résultats";
}

# bonnes pratiques

// fermeture de la requête
$query->closeCursor();

// fermeture de la connexion
$db = null;

// appel de la vue
include "views/index.view.php";
```

On utilise ensuite la vue `index.view.php` pour afficher les résultats, on peut utiliser une boucle `foreach` pour ça :


```php
<!doctype html>
<html lang="en">
<!-- ... -->
<?php
// si on a des résultats sous forme de tableau
if(is_array($results)):
?>
<h3>Liste des utilisateurs</h3>
<ul>
<?php
// on parcourt les résultats
foreach($results as $result):
?>
<li><?= $result['login'] ?></li>
<?php
endforeach;
?>
</ul>
<?php
// sinon on affiche le message d'erreur (qui est une chaîne)
else:
 ?>
 <h3><?= $results ?></h3>
 <?php
endif;
    ?>
</body>
</html>
```


---

[Retour au menu](#menu)

---

#### Documentation sur `fetchAll`
`PDOStatement::fetchAll()` récupère toutes les lignes d'un jeu de résultats PDOStatement et le retourne sous forme de tableau indexé contenant des tableaux associatifs, des tableaux indexés ou des objets selon le mode de récupération défini.

https://www.php.net/manual/fr/pdostatement.fetchall.php

---

[Retour au menu](#menu)

---

## PDO : Les requêtes préparées

Les requêtes préparées sont une fonctionnalité de PDO qui permet de préparer une requête SQL avant de l'exécuter. Cela permet de séparer la requête SQL des données, ce qui permet d'éviter les **injections SQL**.

Les requêtes préparées sont plus sécurisées et plus performantes que les requêtes non préparées, car elles permettent de préparer la requête une seule fois et de l'exécuter plusieurs fois avec des données différentes.

La méthode `PDO::prepare` prépare une requête SQL à être exécutée en offrant la possibilité
de mettre des marqueurs qui seront substitués lors de l'exécution.

Il existe deux types de marqueurs qui sont respectivement `?` et les marqueurs nominatifs (par exemple `:marqueur`).
Ces marqueurs ne sont pas mélangeables : donc pour une même requête, il faut choisir l'une ou l'autre des options.

On peut attribuer des valeurs aux marqueurs en utilisant la méthode `bindValue` ou `bindParam`. On peut aussi utiliser la méthode `execute` pour exécuter la requête en passant les valeurs des marqueurs en paramètre dans un tableau.

La requête ne sera exécutée qu'une fois que toutes les valeurs des marqueurs auront été attribuées et que la méthode `execute` aura été appelée.

---

[Retour au menu](#menu)

---

###  Méthode `prepare`
La méthode prepare() est utilisée pour préparer une requête SQL à l'exécution. Elle analyse la requête et la "prépare" pour une exécution ultérieure avec des données spécifiques. Au lieu d'insérer directement les valeurs dans la requête SQL, vous utilisez des marqueurs (soit des noms, soit des points d'interrogation).

Syntaxe:
```php
PDO::prepare(string $query, array $options = []):
PDOStatement|false
```

`$query` : La requête SQL à préparer.

`$options` : Un tableau d'options pour personnaliser le comportement de la requête préparée (optionnel).

Exemple avec des `marqueurs nommés` :

```php
<?php
$pdo = new PDO(...);

$requete = $pdo->prepare(
  "SELECT * FROM utilisateurs 
  WHERE email = :email"
  );
// ":email" est un marqueur nommé
```

Exemple avec des points d'interrogation :

```php
<?php
$pdo = new PDO(...);

$requete = $pdo->prepare(
  "SELECT * FROM utilisateurs 
  WHERE email = ?"
  );
// "?" est un marqueur positionnel
?>
```

#### Documentation sur `prepare`

Cette méthode permet de préparer une requête SQL à l'exécution. Elle analyse la requête et la "prépare" pour une exécution ultérieure avec des données spécifiques.

https://www.php.net/manual/fr/pdo.prepare.php



---

[Retour au menu](#menu)

---

### Méthode `bindParam`
La méthode bindParam() lie une variable PHP à un marqueur nommé ou à un point d'interrogation dans la requête préparée. La valeur de la variable est évaluée au moment de l'exécution de la requête. Cela signifie que si vous changez la valeur de la variable après l'appel à bindParam() mais avant l'appel à execute(), la nouvelle valeur sera utilisée.

Syntaxe :

```php
PDOStatement::bindParam(string|int $param, 
mixed &$var, int $type = PDO::PARAM_STR, 
int $maxLength = 0): bool
```

`$param` : Le nom du paramètre (pour les marqueurs nommés, par exemple : `:nom` ou `:prenom`) ou la position du paramètre (pour les points d'interrogation, en commençant à 1).

`&$var` : Une référence à la variable PHP que vous voulez lier au paramètre. C'est crucial, car bindParam travaille avec la référence, et non avec la valeur directe !

`$type` : Le type de données du paramètre (optionnel). Les constantes PDO::PARAM_* sont utilisées (par exemple, PDO::PARAM_STR, PDO::PARAM_INT, PDO::PARAM_BOOL). Si omis, PDO::PARAM_STR est utilisé par défaut.

`$maxLength` : Une indication de la longueur maximale des données (optionnel).

Exemple avec un marqueur nommé :

```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
  SELECT * FROM utilisateurs 
  WHERE email = :email ;
  ");
$email = "test@example.com";
$requete->bindParam(':email', $email, PDO::PARAM_STR);
$requete->execute(); // La valeur de $email 
                     // ("test@example.com") est utilisée ici
$resultats = $requete->fetchAll();
$requete->closeCursor();
$pdo=null;
?>
```

Exemple avec un point d'interrogation (attention lecture de gauche à droite en commençant à 1) :

```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
  SELECT * 
  FROM produits 
  WHERE id = ? AND categorie = ? ;
  ");
$id = 123;
$categorie = "électronique";
$requete->bindParam(1, $id, PDO::PARAM_INT);
$requete->bindParam(2, $categorie, PDO::PARAM_STR);
$requete->execute();
$resultats = $requete->fetchAll();
$requete->closeCursor();
$pdo=null;
?>
```

#### Documentation sur `bindParam`

Cette méthode lie une variable PHP à un marqueur nommé ou à un point d'interrogation dans la requête préparée. La valeur de la variable est évaluée au moment de l'exécution de la requête et est liée par référence.

https://www.php.net/manual/fr/pdostatement.bindparam.php

---

[Retour au menu](#menu)

---


### Méthode `bindValue`
La méthode bindValue() associe une valeur à un marqueur nommé ou à un point d'interrogation dans la requête préparée. Contrairement à bindParam(), la valeur est évaluée au moment de l'appel à bindValue(). Les changements ultérieurs à la variable n'affecteront pas la valeur utilisée dans la requête.

Syntaxe :
```php
PDOStatement::bindValue(string|int $param, 
mixed $value, int $type = PDO::PARAM_STR): bool
```

`$param` : Le nom du paramètre (pour les marqueurs nommés) ou la position du paramètre (pour les points d'interrogation).

`$value` : La valeur à lier au paramètre. Ici, vous passez directement la valeur, et non une référence à une variable.

`$type` : Le type de données du paramètre (optionnel, utilise les constantes PDO::PARAM_*).

Exemple avec un marqueur nommé :

```php
<?php
$pdo = new PDO("...");
$requete = $pdo->prepare("
        INSERT INTO articles (titre, contenu) 
        VALUES (:titre, :contenu);
        ");
$requete->bindValue(':titre', "Mon Super Article", PDO::PARAM_STR);
$contenu = "Ceci est le contenu de mon article.";
$requete->bindValue(':contenu', $contenu, PDO::PARAM_STR);
$requete->execute();
?>
```

Exemple avec un point d'interrogation :

```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
    SELECT * 
    FROM produits 
    WHERE prix > ? ;
    ");
$prix = 25.00;
$requete->bindValue(1, $prix, PDO::PARAM_STR); // Note: PDO::PARAM_STR
// peut fonctionner pour les nombres,
// mais PDO::PARAM_INT ou PDO::PARAM_FLOAT
// seraient plus appropriés. ! Pour le
// LIMIT seul PDO::PARAM_INT est utilisé.
$requete->execute();
$resultats = $requete->fetchAll();
$requete->closeCursor();
$pdo=null;
?>
```

---

[Retour au menu](#menu)

---


#### Documentation sur `bindValue`

`PDOStatement::bindValue()` associe une valeur à un paramètre dans une requête préparée.

https://www.php.net/manual/fr/pdostatement.bindvalue.php


---

[Retour au menu](#menu)

---



### Différence Clé entre `bindParam` et `bindValue`

La différence cruciale réside dans le moment où la valeur est évaluée :

`bindParam()` : La valeur de la variable est utilisée au moment de l'appel à execute().

`bindValue()` : La valeur est utilisée au moment de l'appel à bindValue().

Utilisez `bindParam()` si vous avez besoin de modifier la valeur de la variable après la liaison et avant l'exécution de la requête. C'est utile dans les boucles où la valeur change à chaque itération.

#### Avec bindParam
```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
  SELECT * 
  FROM produits 
  WHERE color = ? AND size > ? ;
  ");
$color = "blue";
$size = 5;
$requete->bindParam(1, $color, PDO::PARAM_STR);
$requete->bindParam(2, $size, PDO::PARAM_INT);

$requete->execute(); // color = 'blue' & size > 5
$color = "red";
$size = 7;
$requete->execute();// color = 'red' & size > 7
$color = "green";
$size = 4;
$requete->execute();// color = 'green' & size > 4
```

#### Avec bindValue
```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
  SELECT * 
  FROM produits 
  WHERE color = ? AND size > ? ;
  ");
$color = "blue";
$size = 5;
$requete->bindValue(1, $color, PDO::PARAM_STR);
$requete->bindValue(2, $size, PDO::PARAM_INT);

$requete->execute(); // color = 'blue' & size > 5
$color = "red";
$size = 7;
$requete->execute();// reste color = 'blue' & size > 5
$color = "green";
$size = 4;
$requete->execute();// color = 'blue' & size > 5
```

Utilisez `bindValue()` si la valeur est connue au moment de la liaison et ne changera pas. C'est plus direct et plus simple dans la plupart des cas.

---

[Retour au menu](#menu)

---

### Méthode `execute`

La méthode `execute` permet l'exécution de la requête préparée, on peut aussi l'utiliser en raccourci à la méthode `bindValue` en y passant un tableau indexé contenant les valeurs des marqueurs `?` ou un tableau associatif contenant les valeurs des marqueurs `:nom`.

```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
    SELECT * 
    FROM produits 
    WHERE prix > ?
    AND size > ? ;
    ");
$requete->execute([25,8]);
```

Ou plus rarement avec des marqueurs nommés :

```php
<?php
$pdo = new PDO(...);
$requete = $pdo->prepare("
    SELECT * 
    FROM produits 
    WHERE prix > :prix
    AND size > :size ;
    ");
$requete->execute(["prix" => 25,"size" => 8]);
```

---

[Retour au menu](#menu)

---

#### Documentation sur `execute`

`PDOStatement::execute()` exécute une instruction SQL préparée et retourne le nombre de lignes affectées.

https://www.php.net/manual/fr/pdostatement.execute.php

---

[Retour au menu](#menu)

---



