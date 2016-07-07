<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "maLibSQL.pdo.php";

/**
 * @file maLibSecurisation.php
 * Fichier contenant des fonctions de v�rification de logins
 */

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux
 * Elle stocke le pseudo de la personne dans des variables de session : session_start doit avoir été appelé...
 * Elle enregistre aussi une information permettant de savoir si l'utilisateur qui se connecte est administrateur ou non
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($login,$password)
{
	// Ne pas �tre un LOSER : on produit une requ�te SQL qui permet de savoir si les identifiants sont corrects imm�diatement 
	// Plut�t que de r�cup�rer tous les utilisateurs et de devoir les parcourir pour trouver le bon en php... 
	$SQL = "SELECT id FROM user WHERE Login='$login' AND Password='$password'";

	// on profite de la requete pour savoir si l'utilisateur est admin ou non,

	// dans le cas des requetes qui ne renvoient qu'un enregistrement ne contenant qu'un seul champ... 
	// On peut utiliser la fonction SQLGetChamp

	// Ici, on s'attend à recevoir deux champs dans un ou aucun enregistrement, on doit utiliser SQLSelect
	// Au cas où aucun enregistrement n'est trouvé, la fonction SQLSelect renvoie ... false ! 
	// Exactement ce qu'il nous faut ! 

	if ($res = SQLSelect($SQL))
	{
		// La fonction n'a pas renvoy� faux : les identifiants sont donc corrects... 
		// On transforme notre r�sultat en tableau associatif puis on r�cup�re les valeurs 
		$tabAsso = parcoursRs($res); 
		$_SESSION["id"] = $tabAsso[0]["id"];
		$_SESSION["connecte"] = true;
		$_SESSION["pseudo"] = $login;

		return true;

	} else 
		return false;
	
}

/**
 * Fonction � placer au d�but de chaque page priv�e
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur 
	et arr�te l'interpr�tation si l'utilisateur n'est pas connect�
 * Elle ne fait rien si l'utilisateur est connect�, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlGood=false)
{
	if (! valider("connecte","SESSION")) {
		rediriger("index.php","page=L");
		die("");
	}
	else {
		if ($urlGood)
			rediriger($urlGood);
	}
}

?>
