<?php
# index.php | Contrôleur frontal

// on appelle le fichier config-prod.php (requis une seule fois).

// en utilisant un try / catch
// on se connecte à la DB 'pdo_c2' via PDO
// en utilisant les constantes de connexion
// et en activant les erreurs et le fetchAssoc par défaut

// suivant l'existence de certaines variables get
if(!empty($_GET)) {
// effectuez la requête SQL propre à chaque page, puis appelez les vues vers les pages




}else{
    // appel de la vue de l'accueil
    include "../view/accueil.view.php";
}

// fermeture de la requête
// fermeture de connexion