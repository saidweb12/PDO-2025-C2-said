<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).

// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// en utilisant un try / catch

// on effectue une requête où on prend les 20 derniers articles
// par `thearticle`.`thearticledate` descendant avec query()

// transformation en tableau associatif (fetchAll)

// fermeture de la requête
// fermeture de connexion

// appel de la vue
include"accueilView.php";