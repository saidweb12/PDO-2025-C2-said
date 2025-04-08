<?php
# Contrôleur frontal
require_once "../config-prod.php"; // Appelle le fichier de configuration "config-prod.php" une seule fois
# Appelle le fichier de configuration "config-prod.php" une seule fois

# Utilisation d'un try/catch pour gérer les exceptions
# et connexion à la base de données

/*
 * Attention !
 * appel d'un routeur se trouvant dans le dossier `controller`
 * Il fera les requêtes et affichera les résultats dans les vues
 * Regardez accueilView.php comme page par défaut
 */


include "../controller/routeController.php";