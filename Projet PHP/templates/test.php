<?php
$id = $_SESSION['idtest'];
$nom = getnomtest($id);
$cand = $_SESSION['idcandidat'];
$q = [
    "A","B","C","D","E","F","G","H","I"
];
?>

<script>
    $(document).ready(function() {
        $(".btn-right").click(function () {
            if (!$(".btn-right").hasClass('Unclickable')) {
                $(".form-group:visible").fadeOut();
                $(".form-group:visible").next().fadeIn();

                if ($(".form-group:visible").attr("value") == $(".form-group:first").attr("value"))
                    $(".div-btn-left > *").removeClass("Unclickable");
                if ($(".form-group:visible").attr("value") == $(".form-group:last").prev().attr("value")) {
                    $(".div-btn-right > .btn-right").addClass("Unclickable");
                    $(".fin").css('display','block');
                }
            }
        });

        $(".btn-left").click(function () {
            if (!$(".btn-left").hasClass('Unclickable')) {
                $(".form-group:visible").fadeOut();
                $(".form-group:visible").prev().fadeIn();

                if ($(".form-group:visible").attr("value") == $(".form-group:first").attr("value"))
                    $(".div-btn-left > *").addClass("Unclickable");
                if ($(".form-group:visible").attr("value") == ($(".form-group:last").attr("value") - 1))
                    $(".div-btn-right > *").removeClass("Unclickable");
                    $(".fin").css('display','none');
            }
        });
        $(".btn-left, .btn-left > *").addClass("Unclickable");
    });
</script>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 3vh;
        margin-bottom: 3vh;
        font-size: 6vh;
        text-align: center;
    }

    .form-group {
        margin-top: 4vh;
        height: 70vh;
        vertical-align: middle;
    }

    .question {
        font-size: 4vh;
        margin-bottom: 6vh;
    }

    /* Cachons la case à cocher */
    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked,
    [type="radio"]:not(:checked),
    [type="radio"]:checked {
        position: absolute;
        left: -9999px;
    }
    
    label {
        -webkit-transition: background 2s;
        -moz-transition: background 2s;
        -ms-transition: background 2s;
        -o-transition: background 2s;
        background-color: white;
        background: linear-gradient(to right, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    [type="radio"]:not(:checked) + label,
    [type="radio"]:checked + label,
    [type="checkbox"]:not(:checked) + label,
    [type="checkbox"]:checked + label {
        font-size: 2.5vh;
        height: 8vh;
        cursor: pointer;    /* affiche un curseur adapté */
        display: flex; /* contexte sur le parent */
        flex-direction: column; /* direction d'affichage verticale */
        justify-content: center; /* alignement vertical */
    }

    [type="radio"]:hover + label,
    [type="checkbox"]:hover + label{
        background-color: #A1A09B;
    }

    [type="radio"]:checked + label,
    [type="checkbox"]:checked + label{
        background-color: #F05F46;
    }

    .div-btn-left {
        text-align: right;
        height: 70vh;
    }

    .div-btn-right {
        text-align: left;
        height: 70vh;
    }

    .btn-left {
        font-size: 15vh;
        color: #ef4527;
        height: 30vh;
        padding-top: 7.5vh;
        margin-top: 20vh;
        cursor: pointer;
        background-color: white;
        background: linear-gradient(to right, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    .btn-right {
        font-size: 15vh;
        color: #ef4527;
        height: 30vh;
        padding-top: 7.5vh;
        margin-top: 20vh;
        cursor: pointer;
        background-color: white;
        background: linear-gradient(to left, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    .btn-left:hover {
        background-color: #A1A09B;
    }

    .btn-right:hover {
        background-color: #A1A09B;
    }

    .Unclickable {
        display: none;
        cursor: default;
    }

    .fin {
        display: none;
        font-size: 15vh;
        color: #ef4527;
        height: 30vh;
        width: 17vh;
        padding-top: 7.5vh;
        margin-top: 20vh;
        cursor: pointer;
        background-color: white;
        background: linear-gradient(to left, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    .fin:hover {
        background-color: #A1A09B;
    }

    #fin {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 20;
        font-size: 0px;
        opacity: 0;
        width: 100%;
        height: 100%;
    }
</style>

<div class="container-fluid">
    <div class="col-sm-12">
        <h1> <?php echo $nom[0]['Nom'] ?> </h1>
    </div>
    <div class="col-sm-2 div-btn-left"><span class="glyphicon glyphicon-menu-left btn-left"></span></div>
    <form class="form-horizontal" role="form" method="post" action="controleur.php">
        <div class="col-sm-8">
            <div class="col-sm-12 form-contain" style="overflow: hidden; height: 70vh !important; text-align: center;">
                <?php
                $p = getquestionreponse_idtest($id);
                $idquestion = getquestion_idtest($id);
                $i = 0;
                foreach ($p as $dataP) {
                    if (isset($idquestion[$i]['id_question']) AND $idquestion[$i]['id_question'] == $dataP['id']){
                        if ($i!=0)
                            echo '</div>';
                        echo '<div class="form-group ' . ($i+1) . '" value="' . $dataP['id'] . '"';
                        if ($i!=0)
                            echo 'style="display: none;"';
                        echo '>';
                        echo '<span class="question">' . ($i+1) . ') ' . $dataP['Intitule_Question'] . '</span>';
                        echo '<br><br>';
                        $lettre = 0;
                        $i++;
                    }
                    if( $dataP['Multiple'] == 1)
                        echo '<input type="checkbox" name="' . $dataP["id"] . '[]" value="' . $dataP["id_rep"] . '" class="reponse" id="' . $dataP["id_rep"] . '"/> <label class="col-sm-12" for="' . $dataP["id_rep"] . '">' . $q[$lettre] . ') ' . $dataP["Intitule_reponse"] . '</label>';
                    else
                        echo '<input type="radio" name="' . $dataP["id"] . '" value="' . $dataP["id_rep"] . '" class="reponse" id="' . $dataP["id_rep"] . '"/> <label class="col-sm-12" for="' . $dataP["id_rep"] . '">' . $q[$lettre] . ') ' . $dataP["Intitule_reponse"] . '</label>';
                    echo '<br>';
                    $lettre++;
                }
                echo '</div>';
                ?>
            </div>
        </div>
        <div class="col-sm-2 div-btn-right">
            <span class="glyphicon glyphicon-menu-right btn-right"></span>
            <span class="glyphicon glyphicon-ok fin"><input type="submit" name="action" value="fin_test" id="fin"/></span>
        </div>
    </form>
</div>