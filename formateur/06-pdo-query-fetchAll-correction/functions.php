<?php
// fonction qui coupe le titre au premier "."
/**
 * cut the title
 * @param string $title
 * @return string
 */
function cutTitle(string $title): string
{
    // variable de sortie
    $output = "";
    // position du premier "." dans la chaîne
    $position = strpos($title,'.');
    // on coupe la chaîne et on la met dans $output
    $output .= substr($title,0,$position);
    // retour obligatoire pour être une fonction
    // (sinon procédure), trim retire les espaces avant et
    // arrières de la chaîne
    return trim($output);
}


