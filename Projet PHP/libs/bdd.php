<?php
/**
 * Created by PhpStorm.
 * User: bduhamel
 * Date: 30/06/2016
 * Time: 14:38
 */
$BDD_host="localhost";
$BDD_user="root";
$BDD_password="";
$BDD_base="test_technique";

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test_technique;charset=utf8', 'root', '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>