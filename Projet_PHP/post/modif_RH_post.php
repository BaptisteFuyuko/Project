<?php
session_start();

include('bdd.php');
include_once "libs/maLibSecurisation.php";

/**
 * Created by PhpStorm.
 * User: bduhamel
 * Date: 01/07/2016
 * Time: 10:07
 */

//Permet de mettre à jour toutes les informations modifiées

if ($_POST['pwd']=="" AND $_POST['login']!="" AND $_POST['nom']!="" AND $_POST['prenom']!="" AND $_POST['BU']!=""){
    $req = $bdd->prepare('UPDATE user SET Login = :nlog, Nom = :nom, Prenom = :prenom, BU_origine = :bu WHERE id = :alog');
    $req->execute(array('nlog' => $_POST['login'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'bu' => $_POST['BU'], 'alog' => $_SESSION['idmodif']));
}
elseif ($_POST['login']!="" AND $_POST['nom']!="" AND $_POST['prenom']!="" AND $_POST['BU']!=""){
    $req = $bdd->prepare('UPDATE user SET Login = :nlog, Password = :pwd, Nom = :nom, Prenom = :prenom, BU_origine = :bu WHERE id = :alog');
    $req->execute(array('nlog' => $_POST['login'], 'pwd' => $_POST['pwd'],'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'bu' => $_POST['BU'], 'alog' => $_SESSION['idmodif']));
}
else {
    $id = $_SESSION['idmodif'];
    rediriger("index.php","page=MRH&id=$id&ERR=empty");
}

// Redirection du visiteur vers la liste des RH
rediriger("index.php","page=LRH");
?>