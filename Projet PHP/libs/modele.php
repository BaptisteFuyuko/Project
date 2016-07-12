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

function Listingbycat($cat) {
	$SQL = "SELECT candidat.Nom AS Nom, candidat.Prenom AS Prenom, test.Nom AS Nom_Test, passer.Date_exe AS Date_exe, resultat.Score AS Score, resultat.id_resultat as id
			FROM candidat, test, passer, resultat
			WHERE test.Categorie = '$cat'
			AND passer.id_test = test.id_test
			AND candidat.id_candidat = passer.id_candidat
			AND resultat.id_test = test.id_test
			AND resultat.id_candidat = candidat.id_candidat
			";
	return parcoursRs(SQLSelect($SQL));
}

function Listingbytest($id) {
	$SQL = "SELECT candidat.Nom as Nom, candidat.Prenom as Prenom, passer.Date_exe as Date_exe, resultat.Score as Score, resultat.id_resultat as id
			FROM candidat, test, passer, resultat
			WHERE test.id_test = '$id'
			AND passer.id_test = test.id_test
			AND candidat.id_candidat = passer.id_candidat
			AND resultat.id_test = passer.id_test
			AND resultat.id_candidat = candidat.id_candidat
			";
	return parcoursRs(SQLSelect($SQL));
}

function Listingbycand($id) {
	$SQL = "SELECT test.Nom as Nom_Test, passer.Date_exe as Date_exe, resultat.Score as Score, resultat.id_resultat as id
			FROM candidat, test, passer, resultat
			WHERE candidat.id_candidat = '$id'
			AND passer.id_candidat = '$id'
			AND test.id_test = passer.id_test
			AND resultat.id_candidat = '$id'
			AND resultat.id_test = test.id_test
			";
	return parcoursRs(SQLSelect($SQL));
}

function getnom($id){
	$SQL = "SELECT Nom from test WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getnomprenom($id){
	$SQL = "SELECT Nom, Prenom from candidat WHERE id_candidat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getquestionreponse($id) {
	$SQL = "SELECT question.id_question as id, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, reponse.Juste as Juste
			FROM question, reponse
			WHERE question.id_test = $id
			AND reponse.id_question = question.id_question";
	return parcoursRs(SQLSelect($SQL));
}
?>
