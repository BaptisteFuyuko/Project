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

function getselecteduserinfo($id) {
	$SQL = "SELECT * FROM user WHERE id = '$id'";
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
























function getnomtestbyresult($id){
	$SQL = "SELECT Nom from test, resultat 
			WHERE test.id_test = resultat.id_test
			AND resultat.id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getnomprenom($id){
	$SQL = "SELECT Nom, Prenom from candidat WHERE id_candidat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}


function getidtestfromresult($id){
	$SQL = "SELECT id_test as id from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getquestionreponse_idresult($idresult) {
	$idtest = getidtestfromresult($idresult)[0]['id'];
	$SQL = "SELECT reponse.id_question as id, reponse.id_reponse as id_rep, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, reponse.Juste as Juste
			FROM question, reponse
			WHERE question.id_test = '$idtest'
			AND reponse.id_question = question.id_question
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

function getquestionreponse_idtest($idtest){
	$SQL = "SELECT question.id_question as id, reponse.id_reponse as id_rep, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, question.Multiple as Multiple
			FROM question, reponse
			WHERE question.id_test = '$idtest'
			AND reponse.id_question = question.id_question
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

function getscore($id) {
	$SQL = "SELECT Score from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getidcandfromresult($id){
	$SQL = "SELECT id_candidat as id from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getcand($id) {
	$idcand = getidcandfromresult($id)[0]['id'];
	$SQL = "SELECT Nom, Prenom from candidat WHERE id_candidat = '$idcand'";
	return parcoursRs(SQLSelect($SQL));
}

function getreponsescand($id) {
	$idcand = getidcandfromresult($id)[0]['id'];
	$SQL = "SELECT reponse.id_reponse as id_rep from reponse, repondre, question, test, resultat
			WHERE repondre.id_candidat = '$idcand'
			AND repondre.id_reponse = reponse.id_reponse
			AND reponse.id_question = question.id_question
			AND question.id_test = test.id_test
			AND test.id_test = resultat.id_test
			AND resultat.id_resultat = '$id'
			ORDER BY question.id_question";
	return parcoursRs(SQLSelect($SQL));
}

function getdate_exe($id_result){
	$SQL = "SELECT passer.Date_exe FROM passer, resultat
			WHERE passer.id_test = resultat.id_test
			AND passer.id_candidat = resultat.id_candidat
			AND resultat.id_resultat = '$id_result'";
	return parcoursRs(SQLSelect($SQL));
}
































function getcandbyemail($email) {
	$SQL = "SELECT Nom, Prenom, id_candidat AS id FROM candidat WHERE E_Mail = '$email'";
	if (SQLSelect($SQL) == false)
		return false;
	return parcoursRs(SQLSelect($SQL));
}

function createnewcand($nom, $prenom, $email) {
	$SQL = "INSERT INTO candidat(Nom, Prenom, E_Mail) VALUES ('$nom', '$prenom', '$email')";
	return SQLInsert($SQL);
}

function testdone($cand, $test) {
	$SQL = "SELECT * FROM passer WHERE id_candidat = '$cand' AND id_test = '$test'";
	if (SQLSelect($SQL)==false)
		return false;
	else return true;
}

function updatetest($idcand, $idtest) {
	$SQL = "UPDATE passer SET Date_exe = CURDATE() WHERE id_test = '$idtest' AND id_candidat = '$idcand'";
	SQLUPDATE($SQL);
	$SQL = "DELETE FROM repondre USING repondre INNER JOIN reponse INNER JOIN question INNER JOIN test 
			WHERE repondre.id_candidat = '$idcand' 
			AND repondre.id_reponse = reponse.id_reponse
			AND reponse.id_question = question.id_question
			AND question.id_test = test.id_test
			AND test.id_test = '$idtest'";
	SQLDelete($SQL);
}

function addpasser($idcand, $idtest) {
	$SQL = "INSERT INTO passer(Date_exe, id_candidat, id_test) VALUES (CURDATE(),'$idcand','$idtest')";
	SQLInsert($SQL);
}

function getnomtest($id){
	$SQL = "SELECT Nom FROM test WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getquestion_idtest($id) {
	$SQL = "SELECT id_question FROM question WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function insertrepondre($id_rep, $id_cand){
	$SQL = "INSERT INTO repondre(id_reponse, id_candidat) VALUES ('$id_rep', '$id_cand')";
	SQLInsert($SQL);
}

function getrepandM($id_test) {
	$SQL = "SELECT reponse.id_reponse as id, question.Multiple as Multiple, reponse.id_question as id_question FROM reponse, question
			WHERE reponse.Juste = 1
			AND reponse.id_question = question .id_question
			AND question.id_test = '$id_test'
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

function compare_qcm($reponses, $id_question) {
	$SQL = "SELECT id_reponse FROM reponse WHERE Juste = 1 AND id_question = '$id_question'";
	$correct = parcoursRs(SQLSelect($SQL));
	$cursor = 0;
	foreach ($reponses as $dataP){
		if (isset($correct[$cursor])){
			if ($dataP != $correct[$cursor])
				return 1;
		}
		else
			return 1;
		$cursor++;
	}
	if (isset($correct[$cursor]))
		return 1;
	return 0;
}

function savetest($score, $id_cand, $id_test) {
	$SQL = "INSERT INTO resultat(Score, id_test, id_candidat) VALUES ('$score', '$id_test', '$id_cand')";
	return SQLInsert($SQL);
}

function nbquestion_idtest($id_test) {
	$SQL = "SELECT COUNT(id_question) as nb_question FROM question WHERE id_test='$id_test'";
	return parcoursRs(SQLSelect($SQL));
}

function getidquestion_idrep($id_rep){
	if (is_array($id_rep)){
		$id = $id_rep[0];
		$SQL = "SELECT id_question as id FROM reponse WHERE id_reponse='$id'";
		return parcoursRs(SQLSelect($SQL));
	}
	$SQL = "SELECT id_question as id FROM reponse WHERE id_reponse='$id_rep'";
	return parcoursRs(SQLSelect($SQL));
}
?>
