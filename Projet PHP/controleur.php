<?php
session_start();

include_once "libs/modele.php";
include_once "libs/maLibUtils.php";
include_once "libs/maLibSecurisation.php";

// Cette page recoit des demandes de traitement de base de données
// Elle est sécurisée, et ne doit pouvoir être utilisée que si l'utilisateur connecté
// Si ce n'est pas le cas, elle redirige vers la page appelante si elle existe ou le formulaire de login sinon

// Toute demande contient un champ 'action' indiquant l'action à réaliser
// Une fois le traitement effectué, la page redirige vers la page appelante
// en renvoyant les données les plus pertinentes transmises et un message de feedback

// veiller à vérifier les données transmises à l'aide de la fonction valider()
// et à vous prémunir des injections SQL


if ($action = valider("action", 'POST') OR $action = valider("action", 'GET'))
{
    // Un paramètre action a été soumis, on fait le boulot...

    // Dans tous les cas, il faut etre logue...
    // Sauf si on veut se connecter (action == Se connecter)

    if ($action != "connect")
        securiser();

    switch($action)
    {
        case 'connect' :
            if (	($login = valider("login",'POST')) && 	($passe = valider("mdp",'POST'))	)
            {
                // cet utilisateur est-il valide ??
                if (verifUser($login,$passe)) {
                    // var de session ont été crées
                    // on redirige vers la page d'accueil
                    rediriger("index.php","page=LT");
                } else {
                    rediriger("index.php","page=L&ERR=false");
                }
            }
            else {
                rediriger("index.php","page=L&ERR=empty");
            }
            break;

        case 'modifRH' :
            $p = getlogall();
            $id = $_SESSION['idmodif'];
            foreach($p as $dataP){
                if ($dataP['id']!=$id) {
                    if ($dataP['Login'] == valider("login",'POST'))
                        rediriger("index.php", "page=MRH&id=$id&ERR=double");
                }
            }
                if ($_POST['pwd']=="" AND valider("login",'POST') AND valider("nom",'POST') AND valider("prenom",'POST') AND valider("BU",'POST'))
                    MRH($_SESSION['idmodif'], valider("login",'POST'), valider("nom",'POST'), valider("prenom",'POST'), valider("BU",'POST'));
    
                elseif (valider("login",'POST') AND valider("nom",'POST') AND valider("prenom",'POST') AND valider("BU",'POST'))
                    MRHPWD($_SESSION['idmodif'], valider("login",'POST'), valider("pwd",'POST'), valider("nom",'POST'), valider("prenom",'POST'), valider("BU",'POST'));
    
                else {
                    /**
                     * En cas de champ vide, on vérifie quels champs sont vides :
                     *  - Si le champ est vide, renvoi un "false" pour ce champs par la méthode GET
                     *  - Si le champ n'est pas vide, renvoi la valeur précedemment remplie
                     */
                    if (valider("login",'POST')==false)
                        $login= 'false';
                    else $login = valider("login",'POST');

                    if (valider("nom",'POST')==false)
                        $nom = 'false';
                    else $nom = valider("nom",'POST');

                    if (valider("prenom",'POST')==false)
                        $prenom = 'false';
                    else $prenom = valider("prenom",'POST');

                    if (valider("BU",'POST')==false)
                        $BU = 'false';
                    else $BU = valider("BU",'POST');

                    rediriger("index.php","page=MRH&id=$id&ERR=empty&login=$login&nom=$nom&prenom=$prenom&BU=$BU");
                }
            // Redirection du visiteur vers la liste des RH
            rediriger("index.php","page=LRH");
            break;


        case 'ajoutRH' :
            $p = getlogall();
            $id = $_SESSION['idmodif'];
            foreach($p as $dataP){
                if ($dataP['id']!=$id) {
                    if ($dataP['Login'] == valider("login",'POST'))
                        rediriger("index.php", "page=ARH&ERR=double");
                }
            }
            if (valider("pwd",'POST') AND valider("login",'POST') AND valider("nom",'POST') AND valider("prenom",'POST') AND valider("BU",'POST')){
                AddRH(valider("login",'POST'), valider("pwd",'POST'), valider("nom",'POST'),valider("prenom",'POST'), valider("BU",'POST'));
            }
            else {
                /**
                 * En cas de champ vide, on vérifie quels champs sont vides :
                 *  - Si le champ est vide, renvoi un "false" pour ce champs par la méthode GET
                 *  - Si le champ n'est pas vide, renvoi la valeur précedemment remplie
                 */
                if (valider("pwd",'POST')==false)
                    $pwd= 'false';
                else $pwd = valider("pwd",'POST');

                if (valider("login",'POST')==false)
                    $login= 'false';
                else $login = valider("login",'POST');

                if (valider("nom",'POST')==false)
                    $nom = 'false';
                else $nom = valider("nom",'POST');

                if (valider("prenom",'POST')==false)
                    $prenom = 'false';
                else $prenom = valider("prenom",'POST');

                if (valider("BU",'POST')==false)
                    $BU = 'false';
                else $BU = valider("BU",'POST');

                rediriger("index.php","page=ARH&ERR=empty&pwd=$pwd&login=$login&nom=$nom&prenom=$prenom&BU=$BU");
            }

            // Redirection du visiteur vers la page du minichat
            rediriger("index.php","page=LRH");
            break;

        case 'deluser' :
            if ($iduser = valider("id",'GET')){
                rmuser($iduser);
                rediriger("index.php","page=LRH");
            }
            break;

        case 'lancertest'  :

            break;

        case 'listbycat'  :
            $value = valider("value",'GET');
            rediriger("index.php","page=LRH&value=$value");
            break;

        case 'listbytest'  :
            $id = valider("id",'GET');
            rediriger("index.php","page=LRH&id=$id");
            break;

        case 'listbycand'  :
            $id = valider("id",'GET');
            rediriger("index.php","page=LRH&id=$id");
            break;
    }
}

?>