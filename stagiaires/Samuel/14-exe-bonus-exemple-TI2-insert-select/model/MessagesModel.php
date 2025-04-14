<?php

// création d'une fonction qui va récupérer tous nos messages

function getMessagesOrderByDateDesc (PDO $connection): array
{

    // On prépare la requête
    $prepare = $connection->prepare("
    SELECT * FROM `article`
    ORDER BY `article`.`create_date` DESC
    ");

    // essai / erreur
    try{
        // On exécute la requête
        $prepare->execute();

        // On renvoie le tableau (array) indexé contenant l'ensemble des résultats (il peut être vide si on a pas de message)
        return $prepare->fetchAll();

    // Si on a une erreur SQL
    }catch (Exception $e) {
        // on affiche l'erreur de la requête SQL
        die($e->getMessage());
    }
}

// création d'une fonction qui insert un message dans
// la table `article` en bloquant les injections SQL

function addMessage(PDO $con, string $surname, string $email, string $commentary) : bool|string
{
    // erreur si vide au cas où
    $erreur = "";

    // Protection supplémentaire

    // Verification du nombre de caractères strlen() et la validité du nom
    $surnameProtection = strip_tags($surname); # Ici on retire les tags
    $surnameProtection = htmlspecialchars($surnameProtection); # Ici on protège des caractères speciaux (avec ' et ")
    $surnameProtection = trim($surnameProtection); # Ici on supprime les espaces devant et derrière $surname


    // Condition qui vérifie si le surname est vide
    if(empty($surnameProtection)) {
        $erreur .= "Votre surname est incorrect.<br>";
    

    // Ici on vérifie que le surname est pas plus long que ce qui est autorisé dans la db
    }elseif(strlen($surnameProtection) > 60) {
        $erreur .= "Votre surname est trop long.<br>";
    }

    // Vérification pour l'email
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    // Condition qui vérifie si le mail n'est pas correct
    if($email === false) {
        $erreur .= "Votre email est incorrect.<br>";
    }

    // Vérification du nombre de caractères strlen() et validité sur message
    $commentary = trim(htmlspecialchars(strip_tags($commentary), ENT_QUOTES));
    if(empty($commentary) || strlen($commentary)>500) {
        $erreur .= "Votre commentaire dépasse la limite autorisé de caractères.<br>";
    }

    // Si on détecte au moins 1 erreur 
    if(!empty($erreur)) return $erreur;

    // Si aucune erreur détectée
    $prepare = $con->prepare("
    INSERT INTO `article` (`surname`, `email`, `message`)
    VALUES (?,?,?)
    ");

    try{
        $prepare->execute([$surnameProtection, $email, $commentary]);
        return true;
    }catch(Exception $e) {
        die($e->getMessage());
    }
}


// fonction qui prend le nombre total de `messages`

function getNbTotalMessage(PDO $con): int 
{
    // on compte le nombre de message total
    $query = $con->query("
    SELECT COUNT(*) as nb
    FROM `article`
    ");

    // On renvoi l'entier stocké dans nb
    return $query->fetch()['nb'];
}

// fonction qui ne prend que les articles visibles sur cette page

function getMessagePagination(PDO $con, int $offset, int $limit) : array
{
    $prepare = $con->prepare("
    SELECT * FROM `article`
    ORDER BY `article`.`create_date` DESC
    LIMIT ?,?
    ");

    try{
        $prepare->bindParam(1, $offset,PDO::PARAM_INT);
        $prepare->bindParam(2, $limit,PDO::PARAM_INT);
        $prepare->execute();
        return $prepare->fetchAll();


    }catch (Exception $e) {
        die($e->getMessage());
    }
}


// création d'une fonction qui créer la pagination
function pagination(int $nbTotalMessage, string $get="page", int $pageActuel=1, int $perPage=5): string
{
        // variable de sortie
    $sortie = "";

    // si pas de page nécessaire
    if ($nbTotalMessage === 0) return "";

    // nombre de pages, division du total des messages mis à l'entier supérieur
    $nbPages = ceil($nbTotalMessage / $perPage);

    // si une seule page, pas de lien à afficher
    if ($nbPages == 1) return "";

    // nous avons plus d'une page
    $sortie .= "<p>";


    // tant qu'on a des pages
    for ($i = 1; $i <= $nbPages; $i++) {
        // si on est au premier tour de boucle
        if ($i === 1) {
            // si on est sur la première page
            if ($pageActuel === 1) {
                // pas de lien
                $sortie .= "<< < 1 |";
                // si nous sommes sur la page 2
            } elseif ($pageActuel === 2) {
                // tous les liens vont vers la page 1
                $sortie .= " <a href='./'><<</a> <a href='./'><</a> <a href='./'>1</a> |";
                // si nous sommes sur d'autres pages, le retour va vers la page précédente
            } else {
                $sortie .= " <a href='./'><<</a> <a href='?$get=" . ($pageActuel - 1) . "'><</a> <a href='./'>1</a> |";
            }
            // nous ne sommes pas sur le premier ni dernier tour de boucle
        } elseif ($i < $nbPages) {
            // si nous sommes sur la page actuelle
            if ($i === $pageActuel) {
                // pas de lien
                $sortie .= "  $i |";
            } else {
                // si nous ne sommes pas sur la page actuelle
                $sortie .= "  <a href='?$get=$i'>$i</a> |";
            }
            // si nous sommes sur le dernier tour de boucle
        } else {
            // si nous sommes sur la dernière page
            if ($pageActuel >= $nbPages) {
                // pas de lien
                $sortie .= "  $nbPages > >>";
                // si nous ne sommes pas sur la dernière page
            } else {
                // tous les liens vont vers la dernière page
                $sortie .= "  <a href='?$get=$nbPages'>$nbPages</a> <a href='?$get=" . ($pageActuel + 1) . "'>></a> <a href='?$get=$nbPages'>>></a>";
            }
        }
    }
        $sortie .= "</p>";
        return $sortie;
}


