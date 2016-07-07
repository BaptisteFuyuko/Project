<?php

include_once "libs/maLibSecurisation.php";

/**
 * Created by PhpStorm.
 * User: bduhamel
 * Date: 01/07/2016
 * Time: 12:52
 */
include('bdd.php');

if ($_POST['pwd']!="" AND $_POST['login']!="" AND $_POST['nom']!="" AND $_POST['prenom']!="" AND $_POST['BU']!=""){
    $req = $bdd->prepare('INSERT INTO user(Login, Password, Nom, Prenom, BU_origine) VALUES (:log, :pwd, :nom, :prenom, :bu)');
    $req->execute(array('log' => $_POST['login'], 'pwd' => $_POST['pwd'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'bu' => $_POST['BU']));
}
else {
    rediriger("index.php","page=ARH&ERR=empty");
}

// Redirection du visiteur vers la page du minichat
rediriger("index.php","page=LRH");