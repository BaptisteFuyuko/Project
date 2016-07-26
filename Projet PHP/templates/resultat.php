<?php
include("Navbar.php");
$id = $_GET['id'];
$nom = getnomtestbyresult($_GET['id']);
$q = [
    "a","b","c","d","e","f","g","h","i"
];
$score = getscore($_GET['id']);
$cand = getcand($_GET['id']);
$reponses = getreponsescand($_GET['id']);
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 3vh;
        margin-bottom: 3vh;
        font-size: 4.5vh;
    }

    h2{
        margin-bottom: 4vh;
        font-size: 2.5vh;
    }

    #score {
        margin-top: 5vh;
    }

    .cont-question {
        margin-top: 4vh;
    }

    .question {
        margin-bottom: 2vh;
        font-size: 2.5vh;
    }

    .reponse {
        margin-left : 5vh;
        margin-bottom: 0.5vh;
        font-size: 2vh;
    }
</style>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="col-sm-6">
            <h1> <?php echo $nom[0]['Nom'] ?> </h1>
            <h2> <?php echo 'Passé par ' . $cand[0]['Prenom'] . ' ' . $cand[0]['Nom']; ?> </h2>
        </div>
        <div class="col-sm-6">
            <h1 id="score"> <?php echo $score[0]['Score'] . ' sur 20' ?> </h1>
        </div>
        <div class="col-sm-12" style="overflow: auto; max-height: 70vh !important;">
            <?php
            $p = getquestionreponse_idresult($id, true);
            $i = 1;
            $cursrep = 0;
            foreach ($p as $dataP) {
                echo '<div class="cont-question">';
                if ($i == $dataP['id']){
                    echo '<span class="question">' . $i . ') ' . $dataP['Intitule_Question'] . '</span>';
                    echo '<br><br>';
                    $lettre = 0;
                    $i++;
                }
                if ($dataP['Juste'] == 1) {
                    if (isset($reponses[$cursrep]['id_rep']) AND $dataP['id_rep'] == $reponses[$cursrep]['id_rep']) {
                        $cursrep++;
                        echo '<span class="reponse" id="' . $dataP['id_rep'] . '" style="color: green; font-weight: bold">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . ' <span class="glyphicon glyphicon-ok"></span></span>';
                    }
                    else
                        echo '<span class="reponse" id="' . $dataP['id_rep'] . '" style="color: green; font-weight: bold">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . '</span>';
                }
                else
                    if (isset($reponses[$cursrep]['id_rep']) AND $dataP['id_rep'] == $reponses[$cursrep]['id_rep']) {
                        $cursrep++;
                        echo '<span class="reponse" id="' . $dataP['id_rep'] . '" style="color: red; font-weight: bold">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . ' <span class="glyphicon glyphicon-remove"></span></span>';
                    }
                    else
                        echo '<span class="reponse" id="' . $dataP['id_rep'] . '">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . '</span>';
                echo '<br>';
                $lettre++;
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>