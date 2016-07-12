<?php
include("Navbar.php");
$id = $_GET['id'];
$nom = getnom($_GET['id']);
$q = [
    "a","b","c","d","e","f","g","h","i"
]
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 40px;
        margin-bottom: 60px;
        font-size: 4.5vh;
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
        <h1> <?php echo $nom[0]['Nom'] ?> </h1>
        <div class="col-sm-12" style="overflow: auto; max-height: 70vh !important;">
            <?php
            $p = getquestionreponse($id);
            $i = 1;
            foreach ($p as $dataP) {
                echo '<div class="cont-question">';
                if ($i == $dataP['id']){
                    echo '<span class="question">' . $i . ') ' . $dataP['Intitule_Question'] . '</span>';
                    echo '<br><br>';
                    $lettre = 0;
                    $i++;
                }
                if ($dataP['Juste'] == 1) {
                    echo '<span class="reponse" style="color: green; font-weight: bold">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . ' <span class="glyphicon glyphicon-ok"></span></span>';
                }
                else
                    echo '<span class="reponse"">' . $q[$lettre] . ') ' . $dataP['Intitule_reponse'] . '</span>';
                echo '<br>';
                $lettre++;
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>