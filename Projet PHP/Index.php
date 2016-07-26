<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/modele.php";
include_once "libs/maLibForms.php";

//Tableau des pages autorisées à l'include
$pagesOK['MRH'] = 'templates/modif_RH.php';
$pagesOK['LRH'] = 'templates/List_RH.php';
$pagesOK['ARH'] = 'templates/Ajout_RH.php';
$pagesOK['LT'] = 'templates/Accueil.php';
$pagesOK['L'] = 'templates/login.php';
$pagesOK['LTCAT'] = 'templates/listbycat.php';
$pagesOK['LTT'] = 'templates/listbytest.php';
$pagesOK['LTCAN'] = 'templates/listbycand.php';
$pagesOK['RT'] = 'templates/resultat.php';
$pagesOK['T'] = 'templates/test.php';

//Page par defaut
if (valider('connecte','SESSION'))
	$page = 'LT';
else {
    $page = 'L';
}
//Si le $_GET['page'] est dans les keys du tableau $pagesOK
if(!empty($_GET['page'])
    && array_key_exists($_GET['page'], $pagesOK))
{
    //Remplace la valeur par defaut par celle de l'URL
    $page = $_GET['page'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Test Sogeti</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

	</head>
	<body>
		<div class="row content">
            <?php include("templates/Entete.php"); ?>

            <?php include($pagesOK[$page]); ?>
		</div>
	</body>
</html>