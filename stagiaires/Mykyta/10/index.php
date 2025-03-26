<?php

require_once "config-dev.php";

try{
   $db = new PDO(
        DB_CONNECT_TYPE.":host=".DB_CONNECT_HOST.";dbname=".DB_CONNECT_NAME.";port=".DB_CONNECT_PORT.";charset=".DB_CONNECT_CHARSET,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
}catch(Exception $e){
 die($e->getMessage());
}

$request1 = $db ->query("SELECT * From articles ORDER BY date_creation DESC");

if ($request1->rowCount() > 0){
    $result1 = $request1 -> fetchAll();
    $affiche1 = "";
    $i=1;

    foreach($result1 as $item){
        $affiche1 .= "$i) $item[id] | $item[titre] | $item[texte] | $item[date_creation]<br>";
        $i++;
    }

}else{
    echo "1) Pas d'article";
}
$request1 -> closeCursor();
$db = null;

echo $affiche1;