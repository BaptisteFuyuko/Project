<?php

include("maLibSQL.pdo.php"); 
// définit les fonctions SQLSelect, SQLUpdate... 


function rmuser($iduser)
{
	// supprimer un post-it nécessite de supprimer aussi ses marqueurs !
	$SQL = "DELETE FROM user WHERE id='$iduser'";
	SQLDelete($SQL);
}

function MRH($iduser, $login, $nom, $prenom, $bu)
{
	$SQL = "UPDATE user SET Login = '$login', Nom = '$nom', Prenom = '$prenom', BU_origine = '$bu' WHERE id = '$iduser'";
	SQLUPDATE($SQL);
}

function MRHPWD($iduser, $login, $pwd, $nom, $prenom, $bu)
{
	$SQL = "UPDATE user SET Login = '$login', Password = '$pwd', Nom = '$nom', Prenom = '$prenom', BU_origine = '$bu' WHERE id = '$iduser'";
	SQLUPDATE($SQL);
}

function AddRH ($login, $pwd, $nom, $prenom, $bu)
{
	$SQL = "INSERT INTO user(Login, Password, Nom, Prenom, BU_origine) VALUES ('$login', '$pwd', '$nom', '$prenom', '$bu')";
	SQLInsert($SQL);
}

function ListRH(){
	$SQL = "SELECT Nom, Prenom, id, BU_origine FROM user";
	return parcoursRs(SQLSelect($SQL));
}

function getlogall() {
	$SQL = "SELECT Login, id FROM user";
	return parcoursRs(SQLSelect($SQL));
}

function Listnomtest(){
	$SQL = "SELECT Nom, Categorie, id_test from test ORDER BY Nom";
	return parcoursRs(SQLSelect($SQL));
}

function Listcat(){
	$SQL = "SELECT DISTINCT Categorie from test ORDER BY Categorie";
	return parcoursRs(SQLSelect($SQL));
}

function Listcand(){
	$SQL = "SELECT Nom, Prenom, id_candidat from candidat ORDER BY Nom";
	return parcoursRs(SQLSelect($SQL));
}
?>
