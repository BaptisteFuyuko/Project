<?php

include_once "libs/maLibUtils.php";
include_once "libs/maLibSecurisation.php";

/**
 * Created by PhpStorm.
 * User: bduhamel
 * Date: 04/07/2016
 * Time: 10:12
 */

if (	($login = valider("login",'POST')) && 	($passe = valider("mdp",'POST'))	)
{
    // cet utilisateur est-il valide ??
    if (verifUser($login,$passe)) {
        // var de session ont été crées
        // on redirige vers la page d'accueil
        rediriger("index.php","page=LRH");
    } else {
        rediriger("index.php","page=L&ERR=false");
    }
} 
else {
    rediriger("index.php","page=L&ERR=empty");
}