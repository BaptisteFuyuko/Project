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

        case 'logout' :
            // On supprime juste la session
            session_destroy();
            rediriger("index.php","page=L");
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

        case 'listbycat'  :
            $value = valider("value",'GET');
            rediriger("index.php","page=LTCAT&value=$value");
            break;

        case 'listbytest'  :
            $id = valider("id",'GET');
            rediriger("index.php","page=LTT&id=$id");
            break;

        case 'listbycand'  :
            $id = valider("id",'GET');
            rediriger("index.php","page=LTCAN&id=$id");
            break;
        
        case 'lancertest' :
            if (valider("nom",'POST') AND valider("prenom",'POST') AND valider("email",'POST') AND valider("test",'POST')) {
                $nom = valider("nom", 'POST');
                $prenom = valider("prenom", 'POST');
                $email = valider("email", 'POST');
                $idtest = preg_split("/ - /",valider("test", 'POST'))[2];
                $donnees = getcandbyemail($email);
                $idcand = $donnees[0]['id'];
                if ($donnees) {
                    if ($donnees[0]['Nom'] != $nom OR $donnees[0]['Prenom'] != $prenom) {
                        $nom = valider("nom", 'POST');

                        $prenom = valider("prenom", 'POST');

                        $email = valider("email", 'POST');

                        rediriger("index.php","page=LT&aemail=used&nom=$nom&prenom=$prenom&email=$email");
                    }
                    else {
                        if(testdone($idcand,$idtest)){
                            updatetest($idcand,$idtest);
                        }
                        else {
                            addpasser($idcand,$idtest);
                        }
                        $_SESSION['idcandidat'] = $idcand;
                        $_SESSION['idtest'] = $idtest;

                        rediriger("index.php", "page=T");
                    }
                } else {
                    $idcand = createnewcand($nom, $prenom, $email);
                    $_SESSION['idcandidat'] = $idcand;
                    $_SESSION['idtest'] = $idtest;
                    addpasser($idcand,$idtest);

                    rediriger("index.php", "page=T");
                }
            }
            else {
                if (valider("nom",'POST')==false)
                    $nom= 'false';
                else $nom = valider("nom",'POST');

                if (valider("prenom",'POST')==false)
                    $prenom= 'false';
                else $prenom = valider("prenom",'POST');

                if (valider("email",'POST')==false)
                    $email = 'false';
                else $email = valider("email",'POST');

                if (valider("test",'POST')==false)
                    $test = 'false';
                else $test = 'true';

                rediriger("index.php","page=LT&ERR=empty&nom=$nom&prenom=$prenom&email=$email&test=$test");
            }
            break;
        case 'fin_test' :
            $id_cand = $_SESSION['idcandidat'];
            $score = nbquestion_idtest($_SESSION['idtest'])[0]['nb_question'];
            $max = $score;
            $idquestionseg = 0;
            $rep = [];
            $q = 0;
            foreach ($_POST as $POST){
                if ($POST != 'fin_test' AND is_array($POST)){
                    array_push($rep, $POST);
                    foreach ($POST as $reponse) {
                        insertrepondre($reponse, $id_cand);
                    }
                }
                elseif ($POST != 'fin_test'){
                    insertrepondre($POST, $id_cand);
                    array_push($rep, $POST);
                }
            }
            $p = getrepandM($_SESSION['idtest']);
            /*
             * $p :
             *  'id' = id de la réponse
             *  'id_question' = id de la question
             *  'Multiple' = Booléen distinquant les questions à choix multiples
             */
            $cursor = 0;
            foreach ($p as $dataP) {
                if(isset($rep[$cursor])) {
                    $idqrep = getidquestion_idrep($rep[$cursor])[0]['id'];
                    if ($dataP['Multiple'] == 0 AND $dataP['id_question'] == $idqrep) {
                        if ($dataP['id'] != $rep[$cursor])
                            $score--;
                        $cursor++;
                    } elseif ($dataP['Multiple'] == 1){
                        if ($dataP['id_question'] == $idqrep) {
                            $q = $dataP['id_question'];
                            $sous = compare_qcm($rep[$cursor], $dataP['id_question']);
                            $score = $score - $sous;
                            $cursor++;
                        }
                        elseif ($q != $dataP['id_question']) {
                            $q = $dataP['id_question'];
                            $score--;
                        }
                    }
                    else
                        $score--;
                }
                else {
                    if ($idquestionseg != $dataP['id_question']){
                        $idquestionseg = $dataP['id_question'];
                        $score--;
                    }
                }
            }
            $score = ($score * 20)/$max;
            $date = get_date($id_cand, $_SESSION['idtest'])[0]['Date_exe'];
            $id_result = savetest($score, $id_cand, $_SESSION['idtest'], $date);
            rediriger("index.php","page=FT&id=$id_result");
            break;
        
        case 'valider_rh' :
            $id_result = $_POST['result'];
            if(!isset($_POST['mdp']))
                rediriger("index.php","page=FT&id=$id_result&ERR=empty");
            if(!valider_rh($_SESSION['pseudo'], $_POST['mdp']))
                rediriger("index.php","page=FT&id=$id_result&ERR=false");
            rediriger("index.php","page=RT&id=$id_result");
            break;
        
        case 'ajoutTest' :
            $nom = $_POST['nom'];
            $cat = $_POST['cat'];
            $id_test = create_test($nom, $cat);
            $flag_juste = 0;
            foreach ($_POST as $cle => $data) {
                if ($cle != 'nom' AND $cle != 'cat' AND $cle != 'action') {
                    if (!strstr($cle,'-'))
                        $id_question = add_question($data, $id_test);
                    else {
                        $first_char = preg_split("/-/", $cle)[0];
                        if ($first_char == 'J')
                            $flag_juste = 1;
                        elseif ($first_char == 'M')
                                set_multiple($id_question);
                        else {
                                add_reponse($data, $id_question, $flag_juste);
                                $flag_juste = 0;
                        }
                    }
                }
            }
            rediriger("index.php","page=LT");
            break;
        
        case 'modifTest' :
            $nom = $_POST['nom'];
            $cat = $_POST['cat'];
            $id_test = $_POST['id'];
            update_test($nom, $cat, $id_test);
            $flag_juste = 0;
            $flag_old_question = 0;
            $flag_old_reponse = 0;
            $old_questions = get_old_questions($id_test);
            $i = 0;
            $q = 0;
            foreach ($_POST as $cle => $data){
                if ($cle != 'nom' AND $cle != 'cat' AND $cle != 'action'){
                    $varchar = preg_split("/-/", $cle);
                    if ($varchar[0] == 'O'){
                        if ($varchar[1] == 'Q') {
                            $flag_old_question = 1;
                            $id_question = $varchar[2];
                            $old_reponses = get_old_reponses($id_question);
                        }
                        else {
                            $flag_old_reponse = 1;
                            $id_reponse = $varchar[2];
                        }
                    }
                    if ($flag_old_reponse == 0){
                        while (isset($old_reponses[$q]['id_reponse'])){
                            //del_reponse($old_reponses[$q]['id_reponse']);
                            $q++;
                        }
                    }
                    if (!strstr($cle,'-')) {
                        if ($flag_old_question == 0)
                            $id_question = add_question($data, $id_test);
                        else {
                            while (isset($old_questions[$i]['id_question']) AND $id_question != $old_questions[$i]['id_question']){
                                //del_question($old_questions[$i]['id_question']);
                                $i++;
                            }
                            update_question($data, $id_question);
                            $flag_old_question = 0;
                        }
                    }
                    if ($flag_old_question == 0) {
                        while (isset($old_questions[$i]['id_question'])) {
                            //del_question($old_questions[$i]['id_question']);
                            $i++;
                        }
                    }
                    elseif ($varchar[0] == 'M')
                        set_multiple($id_question);
                    elseif ($varchar[0] == 'J')
                        $flag_juste = 1;
                    elseif ($varchar[0] != 'O' AND strstr($cle, '-')) {
                        if ($flag_old_reponse == 0){
                            add_reponse($data, $id_question, $flag_juste);
                            $flag_juste = 0;
                        }
                        else {
                            while(isset($old_reponses[$q]['id_reponse']) AND $id_reponse != $old_reponses[$q]['id_reponse']){
                                //del_reponse($old_reponses[$q]['id_reponse']);
                                $q++;
                            }
                            update_reponse($data, $id_reponse, $flag_juste);
                            $flag_juste = 0;
                            $flag_old_reponse = 0;
                        }
                    }
                }
            }
            rediriger("index.php","page=LT");
            break;
    }
}
?>