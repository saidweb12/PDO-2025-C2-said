<?php
# Chargement des constantes de connexion
require_once "config_pdo_c2.php";


class MyPDO extends PDO
{
    public function __construct(string $dsn, ?string $username = null, ?string $password = null, ?array $options = null)
    {
        parent::__construct($dsn, $username, $password, $options);
        echo "Tu es connecté ! <br>";
    }

    #[\ReturnTypeWillChange]
    public function query($query="", $fetchMode = null, ...$fetchModeArgs): PDOStatement|false|Exception
    {
        throw new Exception("Utilise prepare() !");
    }
}

try{
    // instanciation avec PDO
    $db = new MyPDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
    );
    // on va attribuer à la connexion la manière de gérer les données par PHP
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// si erreur, instanciation de 'Exception' avec $e comme pointeur
}catch(Exception $e){
    // arrêt du script avec die(), et affichage de la méthode se trouvant dans l'instance de 'Exception' via $e
    die($e->getMessage());
}

try {
// on récupère les champs 'idthearticle', 'thearticletitle' et 'thearticledate' lorsque la date est supérieure à '2020-01-01 20:43:30'
    $requestTheArticle = $db->query("
        SELECT a.`idthearticle` as id,
               a.`thearticletitle` as title,
               a.`thearticledate` as `date` -- alias externes (sortie)
            FROM `thearticle` a -- alias interne (la table)
        WHERE
            a.`thearticledate` > '2020-01-01 20:43:30' ;   ");
// récupération de toutes les données au format tableau indexé (fetchAll) contenant des tableaux associatifs ($db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);)
    $resultTheArticle = $requestTheArticle->fetchAll();
}catch (Exception $e){
    die($e->getMessage());
}

var_dump($db,$resultTheArticle);