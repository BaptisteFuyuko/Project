<?php

include("maLibSQL.pdo.php"); // définit les fonctions SQLSelect, SQLUpdate...

/*
 * Fonction permettant la suppression d'un RH
 * @param :
 * 		$iduser = id du RH à supprimer
 */
function rmuser($iduser)
{
	$SQL = "DELETE FROM user WHERE id='$iduser'";
	SQLDelete($SQL);
}

/*
 * Modifie les informations d'un RH sans changer le mot de passe
 * @param :
 * 		$iduser = id du RH à modifier
 * 		$login = nouveau login
 * 		$nom = Nouveau Nom du RH
 * 		$prenom = Nouveau prenom du RH
 * 		$bu = nouvelle BU du RH
 */
function MRH($iduser, $login, $nom, $prenom, $bu)
{
	$SQL = "UPDATE user SET Login = '$login', Nom = '$nom', Prenom = '$prenom', BU_origine = '$bu' WHERE id = '$iduser'";
	SQLUPDATE($SQL);
}

/*
 * Modifie les information d'un RH dont le mot de passe
 * @param :
 * 		$iduser = id du RH à modifier
 * 		$login = nouveau login
 * 		$pwd = nouveau mot de passe du RH
 * 		$nom = Nouveau Nom du RH
 * 		$prenom = Nouveau prenom du RH
 * 		$bu = nouvelle BU du RH
 */
function MRHPWD($iduser, $login, $pwd, $nom, $prenom, $bu)
{
	$SQL = "UPDATE user SET Login = '$login', Password = '$pwd', Nom = '$nom', Prenom = '$prenom', BU_origine = '$bu' WHERE id = '$iduser'";
	SQLUPDATE($SQL);
}

/*
 * Ajoute un RH dans la base :
 * @param :
 * 		$login = login du RH à ajouter
 * 		$pwd = Mot de passe du RH à ajouter
 * 		$nom = Nom du RH à ajouter
 * 		$prenom = Prenom du RH à ajouter
 * 		$bu = BU du RH à ajouter
 */
function AddRH ($login, $pwd, $nom, $prenom, $bu)
{
	$SQL = "INSERT INTO user(Login, Password, Nom, Prenom, BU_origine) VALUES ('$login', '$pwd', '$nom', '$prenom', '$bu')";
	SQLInsert($SQL);
}

/*
 * Liste l'ensemble des RH de la base
 * @return :
 * 		array[x]['Nom'] = Nom du RH en position 'x' dans la liste
 * 		array[x]['Prenom'] = Prenom du RH en position 'x' dans la liste
 * 		array[x]['id'] = id du RH en position 'x' dans la liste
 * 		array[x]['BU_oringine'] = BU du RH en position 'x' dans la liste
 */
function ListRH(){
	$SQL = "SELECT Nom, Prenom, id, BU_origine FROM user";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste les logs et les id des RH
 * @return :
 * 		array[x]['Login'] = Login du RH en position 'x' dans la liste
 * 		array[x]['id'] = ID du RH en position 'x' dans la liste
 */
function getlogall() {
	$SQL = "SELECT Login, id FROM user";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste toutes les informations d'un utilisateur
 * @param :
 * 		$id = id de l'utilisateur dont on cherche les informations
 * @return :
 * 		array[x]['id'] = ID du RH en position 'x' dans la liste
 * 		array[x]['Login'] = Login du RH en position 'x' dans la liste
 * 		array[x]['Password'] = Mot de passe du RH en position 'x' dans la liste
 * 		array[x]['Nom'] = Nom du RH en position 'x' dans la liste
 * 		array[x]['Prenom'] = Prénom du RH en position 'x' dans la liste
 * 		array[x]['BU_origine'] = BU du RH en position 'x' dans la liste
 */
function getselecteduserinfo($id) {
	$SQL = "SELECT * FROM user WHERE id = '$id'";
	return parcoursRs(SQLSelect($SQL));
}
























/*
 * Liste des informations de tous les tests de la base rangés par ordre alphabétique selon leur nom
 * @return :
 * 		array[x]['Nom'] = Nom du test en position 'x' dans la liste
 * 		array[x]['Categorie'] = Catégorie du test en position 'x' dans la liste
 * 		array[x]['id_test'] = ID du test en position 'x' dans la liste
 */
function Listnomtest(){
	$SQL = "SELECT Nom, Categorie, id_test from test ORDER BY Nom";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste les différentes catégories de test de la base rangées par ordre alphabétique selon leur nom
 * @return :
 * 		array[x]['Categorie'] = Nom de la catégorie en position 'x' dans la liste
 */
function Listcat(){
	$SQL = "SELECT DISTINCT Categorie from test ORDER BY Categorie";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste tous les candidats de la bases rangés pas ordre alphabétique selon leur nom
 * @return :
 * 		array[x]['Nom'] = Nom du candidat en position 'x' dans la liste
 * 		array[x]['Prenom'] = Nom du candidat en position 'x' dans la liste
 * 		array[x]['id_candidat'] = id du candidat en position 'x' dans la liste
 */
function Listcand(){
	$SQL = "SELECT Nom, Prenom, id_candidat from candidat ORDER BY Nom";
	return parcoursRs(SQLSelect($SQL));
}


















/*
 * Liste les informations des tests passés dans une catégorie
 * @param :
 * 		$cat = Nom de la catégorie dont on veut lister les tests réalisés
 * @return :
 * 		array[x]['Nom'] = Nom du candidat ayant passé le test en position 'x' dans la liste
 * 		array[x]['Prenom'] = Prénom du candidat ayant passé le test en position 'x' dans la liste
 * 		array[x]['Nom_Test'] = Nom du test en position 'x' dans la liste
 * 		array[x]['Date_exe'] = Date d'exécution du test en position 'x' dans la liste
 * 		array[x]['Score'] = Score obtenu au test en position 'x' dans la liste
 * 		array[x]['id'] = ID du résultat du test en position 'x' dans la liste
 */
function Listingbycat($cat) {
	$SQL = "SELECT candidat.Nom AS Nom, candidat.Prenom AS Prenom, test.Nom AS Nom_Test, resultat.Date_exe AS Date_exe, resultat.Score AS Score, resultat.id_resultat as id
			FROM candidat, test, resultat
			WHERE test.Categorie = '$cat'
			AND resultat.id_test = test.id_test
			AND resultat.id_candidat = candidat.id_candidat
			";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste les informations des tests réalisés
 * @param :
 * 		$id = id_test du test dont on veut lister les réalisations
 * @return :
 * 		array[x]['Nom'] = Nom du candidat ayant passé le test en position 'x' dans la liste
 * 		array[x]['Prenom'] = Prénom du candidat ayant passé le test en position 'x' dans la liste
 * 		array[x]['Date_exe'] = Date d'exécution du test en position 'x' dans la liste
 * 		array[x]['Score'] = Score obtenu au test en position 'x' dans la liste
 * 		array[x]['id'] = ID du résultat du test en position 'x' dans la liste
 */
function Listingbytest($id) {
	$SQL = "SELECT candidat.Nom as Nom, candidat.Prenom as Prenom, resultat.Date_exe as Date_exe, resultat.Score as Score, resultat.id_resultat as id
			FROM candidat, test, resultat
			WHERE test.id_test = '$id'
			AND resultat.id_test = test.id_test
			AND resultat.id_candidat = candidat.id_candidat
			";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Liste les informations des tests réalisés par un candidat
 * @param :
 * 		$id = id_candidat du candidat dont on veut lister les tests
 * @return :
 * 		array[x]['Date_exe'] = Date d'exécution du test en position 'x' dans la liste
 * 		array[x]['Score'] = Score obtenu au test en position 'x' dans la liste
 * 		array[x]['id'] = ID du résultat du test en position 'x' dans la liste
 */
function Listingbycand($id) {
	$SQL = "SELECT test.Nom as Nom_Test, resultat.Date_exe as Date_exe, resultat.Score as Score, resultat.id_resultat as id
			FROM candidat, test, resultat
			WHERE candidat.id_candidat = '$id'
			AND resultat.id_candidat = '$id'
			AND resultat.id_test = test.id_test
			";
	return parcoursRs(SQLSelect($SQL));
}























/*
 * Récupère le nom du test correspondant à un résultat
 * @param :
 * 		$id = id_resultat du résultat dont on veut récuperer le nom du test associé
 * @return :
 * 		array[0]['Nom'] = Nom du test
 */
function getnomtestbyresult($id){
	$SQL = "SELECT Nom from test, resultat 
			WHERE test.id_test = resultat.id_test
			AND resultat.id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère le nom et le prenom d'un candidat
 * @param :
 * 		$id = id_candidat du candidat dont on veut les données
 * @return :
 * 		array[0]['Nom'] = Nom du candidat
 * 		array[0]['Prenom'] = Prénom du candidat
 */
function getnomprenom($id){
	$SQL = "SELECT Nom, Prenom from candidat WHERE id_candidat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère l'ID du test correspondant à un résultat
 * @param :
 * 		$id = id_resultat du résultat dont on veut l'id du test
 * @return :
 * 		array[0]['id'] = id du test
 */
function getidtestfromresult($id){
	$SQL = "SELECT id_test as id from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère les questions et les réponses du test correspondant à un résultat
 * @param :
 * 		$idresult = id_resultat du résultat dont on veut les question et réponses du test associé
 * @return :
 * 		array[x]['id'] = id de la question correspondant à la réponse en position x
 * 		array[x]['id_rep'] = id de la réponse en position x
 * 		array[x]['Intitule_question'] = Intitulé de la question correspondant à la réponse en position x
 * 		array[x]['Intitule_reponse'] = Intitulé de la réponse en position x
 * 		array[x]['Juste'] = Booléen indiquant si la réponse en position x est correct ou non
 */
function getquestionreponse_idresult($idresult) {
	$idtest = getidtestfromresult($idresult)[0]['id'];
	$SQL = "SELECT reponse.id_question as id, reponse.id_reponse as id_rep, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, reponse.Juste as Juste
			FROM question, reponse
			WHERE question.id_test = '$idtest'
			AND reponse.id_question = question.id_question
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère les questions et les réponses d'un test
 * @param :
 * 		$idtest = id_test du test dont on veut les questions et réponses
 * @return :
 * 		array[x]['id'] = id de la question correspondant à la réponse en position x
 * 		array[x]['id_rep'] = id de la réponse en position x
 * 		array[x]['Intitule_question'] = Intitulé de la question correspondant à la réponse en position x
 * 		array[x]['Intitule_reponse'] = Intitulé de la réponse en position x
 * 		array[x]['Multiple'] = Booléen indiquant si la question correspondant à la réponse en position x est un choix multiple ou non
 */
function getquestionreponse_idtest($idtest){
	$SQL = "SELECT question.id_question as id, reponse.id_reponse as id_rep, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, question.Multiple as Multiple
			FROM question, reponse
			WHERE question.id_test = '$idtest'
			AND reponse.id_question = question.id_question
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère le score d'un test
 * @param :
 * 		$id = id_resultat du test dont on veut le score
 * @return :
 * 		array[0]['Score'] = Score réalisé au test
 */
function getscore($id) {
	$SQL = "SELECT Score from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère l'ID du candidat qui à passé un test
 * @param :
 * 		$id = id_resultat du test dont on veut récupérer le candidat
 * @return :
 * 		array[0]['id'] = id_candidat du candidat qui a passé le test
 */
function getidcandfromresult($id){
	$SQL = "SELECT id_candidat as id from resultat WHERE id_resultat = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère les informations d'un candidat à partir de son id
 * @param :
 * 		$id = id_candidat du candidat dont on veut les informations
 * @return :
 * 		array[0]['Nom'] = Nom du candidat
 * 		array[0]['Prenom'] = Prénom du candidat
 */
function getcand($id) {
	$idcand = getidcandfromresult($id)[0]['id'];
	$SQL = "SELECT Nom, Prenom from candidat WHERE id_candidat = '$idcand'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère les réponses d'un candidat à un test
 * @param :
 * 		$id = id_resultat du test dont on veut les réponses données
 * @return :
 * 		array[x]['id_rep'] = id de la réponse en position x donné par le candidat
 */
function getreponses_idresult($id) {
	$SQL = "SELECT reponse.id_reponse as id_rep from reponse, repondre, question, test, resultat
			WHERE repondre.id_candidat = resultat.id_candidat
			AND repondre.id_reponse = reponse.id_reponse
			AND reponse.id_question = question.id_question
			AND question.id_test = test.id_test
			AND test.id_test = resultat.id_test
			AND resultat.id_resultat = '$id'
			ORDER BY question.id_question";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère la date de passage  d'un test
 * @return :
 * 		$id_result = id_resultat du résultat dont on veut récupérer la date de passage
 * @param :
 * 		array[0]['Date_exe'] = Date de passage du test
 */
function getdate_exe($id_result){
	$SQL = "SELECT Date_exe FROM  resultat
			WHERE id_resultat = '$id_result'";
	return parcoursRs(SQLSelect($SQL));
}































/*
 * Récupère les informations d'un candidat à partir de son email si il existe
 * @param :
 * 		$email = Addresse email envoyé pour verifier si le candidat existe dans la base
 * @return :
 * 		Si n'existe pas :
 * 			Renvoie le booléen false pour indiquer que c'est un nouveau candidat
 * 		Si existe :
 * 			array[0]['Nom'] = Nom du candidat associé à l'adresse email
 * 			array[0]['Prenom'] = Prénom du candidat associé à l'adresse email
 * 			array[0]['id'] = id du candidat associé à l'adresse email
 */
function getcandbyemail($email) {
	$SQL = "SELECT Nom, Prenom, id_candidat AS id FROM candidat WHERE E_Mail = '$email'";
	if (SQLSelect($SQL) == false)
		return false;
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Créée un nouveau candidat
 * @param :
 * 		$nom = Nom du nouveau candidat
 * 		$prenom = Prénom du nouveau candidat
 * 		$email = Email du nouveau candidat
 * @return :
 * 		Renvoie l'id du candidat ajouté
 */
function createnewcand($nom, $prenom, $email) {
	$SQL = "INSERT INTO candidat(Nom, Prenom, E_Mail) VALUES ('$nom', '$prenom', '$email')";
	return SQLInsert($SQL);
}

/*
 * Vérifie si un test à déjà été réalisé par un candidat
 * @param :
 * 		$cand = id_candidat du candidat
 * 		$test = id_test du test
 * @return
 * 		false si pas encore réalisé
 * 		true si déjà réalisé
 */
function testdone($cand, $test) {
	$SQL = "SELECT * FROM passer WHERE id_candidat = '$cand' AND id_test = '$test'";
	if (SQLSelect($SQL)==false)
		return false;
	else return true;
}

/*
 * Met à jour les information d'un test quand celui-ci est réalisé à nouveau
 * @param :
 * 		$idcand = id_candidat du candidat dont on veut mettre à jour le test
 * 		$idtest = id_test du test correspondant au résultat qu'on veut modifier
 */
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

/*
 * Ajoute le passage d'un test par un candidat
 * @param :
 * 		$idcand = id_candidat du candidat qui passe le test
 * 		$idtest = id_test du test qui est réalisé
 */
function addpasser($idcand, $idtest) {
	$SQL = "INSERT INTO passer(Date_exe, id_candidat, id_test) VALUES (CURDATE(),'$idcand','$idtest')";
	SQLInsert($SQL);
}

/*
 * Récupère le nom d'un test
 * @param :
 * 		$id = id_test du test dont on veut récupérer le nom
 * @return :
 * 		array[0]['Nom'] = Nom du test
 */
function getnomtest($id){
	$SQL = "SELECT Nom FROM test WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère les id_question des questions d'un test
 * @param :
 * 		$id = id_test du test dont on veut récupérer les questions
 * @return :
 * 		array[x]['id_question'] = id_question de la question se trouvant à la position x
 */
function getquestion_idtest($id) {
	$SQL = "SELECT id_question FROM question WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Insert une réponse donnée par un candidat
 * @param :
 * 		$id_rep = id_reponse de la réponse donnée par le candidat
 * 		$id_cand = id_candidat du candidat qui a répondu au test
 */
function insertrepondre($id_rep, $id_cand){
	$SQL = "INSERT INTO repondre(id_reponse, id_candidat) VALUES ('$id_rep', '$id_cand')";
	SQLInsert($SQL);
}

/*
 * Récupère les bonnes réponses ainsi que l'id de la question associée à un test
 * @param :
 * 		$id_test = id_test du test dont on veut récupérer les bonnes réponses
 * @return :
 * 		array[x]['id'] = id_reponse de la réponse à la position x
 * 		array[x]['id_question'] = id_question de la question associé à la réponse en position x
 * 		array[x]['Multiple'] = Booléen indiquand si la question associée à la réponse en position x est un choix multiple
 */
function getrepandM($id_test) {
	$SQL = "SELECT reponse.id_reponse as id, reponse.id_question as id_question, question.Multiple as Multiple FROM reponse, question
			WHERE reponse.Juste = 1
			AND reponse.id_question = question .id_question
			AND question.id_test = '$id_test'
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Vérifie si les réponses à une question à choix multiple sont corrects
 * @param :
 * 		$reponses = tableau contenant les réponses du candidat à la question
 * 		$id_question = id_question de la question à choix multiple
 * @return :
 * 		1 si les réponses sont fausses, si il n'a pas répondu ou si il a donné plus de réponses qu'il ne le faut
 * 		0 si les réponses sont correctes
 */
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

/*
 * Sauvegarde le résultat au test qui vient d'être réalisé
 * @param :
 * 		$score = score obtenu au test
 * 		$id_cand = id_candidat du candidat qui a passé le test
 * 		$id_test = id_test tu test réalisé
 * 		$date = Date d'éxecution du test
 * @return :
 * 		Retourne l'id du résultat qui vient d'être enregistré
 */
function savetest($score, $id_cand, $id_test, $date) {
	$SQL = "INSERT INTO resultat(Score, id_test, id_candidat, Date_exe) VALUES ('$score', '$id_test', '$id_cand', '$date')";
	return SQLInsert($SQL);
}

/*
 * Récupère le nombre de question d'un test
 * @param :
 * 		$id_test = id_test du test dont on veut compter les question
 * @return :
 * 		array[0]['nb_question'] = nombre de questions du test
 */
function nbquestion_idtest($id_test) {
	$SQL = "SELECT COUNT(id_question) as nb_question FROM question WHERE id_test='$id_test'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère l'id de la question associèe à une réponse
 * @param :
 * 		$id_rep = id_reponse de la réponse dont on veut l'id de la question associée
 * @return :
 * 		array[0]['id'] = id_question de la question associé à la réponse
 */
function getidquestion_idrep($id_rep){
	if (is_array($id_rep)){
		$id = $id_rep[0];
		$SQL = "SELECT id_question as id FROM reponse WHERE id_reponse='$id'";
		return parcoursRs(SQLSelect($SQL));
	}
	$SQL = "SELECT id_question as id FROM reponse WHERE id_reponse='$id_rep'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Récupère la date de réalisation d'un test
 * @param :
 * 		$id_cand = id_candidat du candidat qui a passé le test
 * 		$id_test = id_test du test réalisé
 * @return :
 * 		array[0]['Date_exe'] = Date de réalisation du test
 */
function get_date($id_cand, $id_test){
	$SQL = "SELECT Date_exe FROM passer 
			WHERE id_candidat = '$id_cand'
			AND id_test = '$id_test'";
	return parcoursRs(SQLSelect($SQL));
}

/*
 * Vérifie le code RH renseigné
 * @param :
 * 		$login = Login du RH dont on veut vérifier le code
 * 		$mdp = Mot de passe renseigné sur le formulaire
 * @return :
 * 		false si le mot de passe ne correspond pas
 * 		true si le mot de passe correspond
 */
function valider_rh($login, $mdp) {
	$SQL = "SELECT Password FROM user WHERE Login = '$login'";
	$bon_mdp = parcoursRs(SQLSelect($SQL))[0]['Password'];
	if ($bon_mdp == $mdp)
		return true;
	return false;
}

function list_test_cat($cat){
	$SQL = "SELECT Nom, id_test as id FROM test WHERE Categorie = '$cat'";
	return parcoursRs(SQLSelect($SQL));
}

























function create_test($nom, $cat){
	$SQL = "INSERT INTO test(Nom, Categorie) VALUES ('$nom', '$cat')";
	return SQLInsert($SQL);
}

function add_question($intitule, $id_test){
	$SQL = "INSERT INTO question(Intitule, id_test, Multiple) VALUES ('$intitule', '$id_test', 0)";
	return SQLInsert($SQL);
}

function set_multiple($id_question){
	$SQL = "UPDATE question SET Multiple = 1 WHERE id_question ='$id_question'";
	SQLUpdate($SQL);
}

function add_reponse($intitule, $id_question, $flag_juste){
	$SQL = "INSERT INTO reponse(Intitule, Juste, id_question) VALUES ('$intitule', '$flag_juste', '$id_question')";
	SQLInsert($SQL);
}

function getinfostest($id){
	$SQL = "SELECT Nom, Categorie FROM test WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getquestionreponsejuste_idtest($idtest){
	$SQL = "SELECT reponse.Juste as Juste, question.id_question as id, reponse.id_reponse as id_rep, question.Intitule as Intitule_Question, reponse.Intitule as Intitule_reponse, question.Multiple as Multiple
			FROM question, reponse
			WHERE question.id_test = '$idtest'
			AND reponse.id_question = question.id_question
			ORDER BY reponse.id_question";
	return parcoursRs(SQLSelect($SQL));
}

function update_test($nom, $cat, $id_test){
	$SQL = "UPDATE test SET Nom = '$nom', Categorie = '$cat' WHERE id_test = '$id_test'";
	SQLUpdate($SQL);
}

function update_question($data, $id_question){
	$SQL = "UPDATE question SET Intitule = '$data' WHERE id_question = '$id_question'";
	SQLUpdate($SQL);
}

function update_reponse($data, $id_reponse, $flag_juste){
	$SQL = "UPDATE reponse SET Intitule = '$data', Juste = '$flag_juste' WHERE id_reponse = '$id_reponse'";
	SQLUpdate($SQL);
}

function get_old_questions($id){
	$SQL = "SELECT id_question FROM question WHERE id_test = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function get_old_reponses($id){
	$SQL = "SELECT id_reponse FROM reponse WHERE id_question = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

function del_question($id){
	$SQL = "DELETE FROM reponse WHERE id_question = '$id'";
	SQLDelete($SQL);
	$SQL = "DELETE FROM question WHERE id_question = '$id'";
	SQLDelete($SQL);
}

function del_reponse($id){
	$SQL = "DELETE FROM reponse WHERE id_reponse = '$id'";
	SQLDelete($SQL);
}
?>