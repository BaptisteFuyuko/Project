<?php
$id = $_SESSION['idtest'];
$nom = getnomtest($id);
$cand = $_SESSION['idcandidat'];
$q = [
    "A","B","C","D","E","F","G","H","I"
];
?>

<script>
    $(document).ready(function(){
        $(".btn-right").click(function () {
            $(".form-group:visible").hide('slide', {direction: 'left'}, 1400);
            $(".form-group:visible").next().stop().show('slide', {direction: 'left'}, 1400);
        });

        $(".btn-left").click(function () {
            $(".form-group:visible").hide('slide', {direction: 'right'}, 1400);
            $(".form-group:visible").prev().stop().show('slide', {direction: 'left'}, 1400);
        });
        if ($(".form-group:visible").val()== 1)
            alert('1');
    });
</script>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 5vh;
        margin-bottom: 3vh;
        font-size: 6vh;
        text-align: center;
    }

    .form-group {
        margin-top: 6vh;
        height: 100%;
    }

    .question {
        font-size: 3vh;
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
        height: 10vh;
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

    .btn-left {
        text-align: right;
        height: 65vh;
    }

    .btn-right {
        text-align: left;
        height: 65vh;
    }

    .glyphicon-menu-left {
        font-size: 15vh;
        color: #ef4527;
        height: 30vh;
        padding-top: 7.5vh;
        margin-top: 17.5vh;
        cursor: pointer;
        background-color: white;
        background: linear-gradient(to right, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    .glyphicon-menu-right {
        font-size: 15vh;
        color: #A1A09B;
        height: 30vh;
        padding-top: 7.5vh;
        margin-top: 17.5vh;
        cursor: pointer;
        background-color: white;
        background: linear-gradient(to left, rgba(255,255,255,0), white);
        transition: background-color 0.3s;
    }

    .glyphicon-menu-left:hover {
        background-color: #A1A09B;
    }

    .glyphicon-menu-right:hover {
        background-color: #F05F46;
    }
</style>

<div class="container-fluid">
    <div class="col-sm-12">
        <h1> <?php echo $nom[0]['Nom'] ?> </h1>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-2 btn-left"><span class="glyphicon glyphicon-menu-left"></span></div>
    <div class="col-sm-6">
        <div class="col-sm-12" style="overflow: hidden; height: 65vh !important; text-align: center;">
            <?php
            $p = getquestionreponse_idtest($id);
            $idquestion = getquestion_idtest($id);
            $i = 0;
            foreach ($p as $dataP) {
                if ($idquestion[$i]['id_question'] == $dataP['id']){
                    if ($i!=0)
                        echo '</div>';
                    echo '<div class="form-group ' . ($i+1) . '" value="' . $dataP['id'] . '"';
                    if ($i!=0)
                        echo 'style="display : none;"';
                    echo '>';
                    echo '<span class="question">' . ($i+1) . ') ' . $dataP['Intitule_Question'] . '</span>';
                    echo '<br><br>';
                    $lettre = 0;
                    $i++;
                }
                echo '<input type="radio" name="' . $dataP["id"] . '" class="reponse" id="' . $dataP["id_rep"] . '"/> <label class="col-sm-12" for="' . $dataP["id_rep"] . '">' . $q[$lettre] . ') ' . $dataP["Intitule_reponse"] . '</label>';
                echo '<br>';
                $lettre++;
            }
            echo '</div>';
            ?>
        </div>
    </div>
    <div class="col-sm-2 btn-right"><span class="glyphicon glyphicon-menu-right"></span></div>
    <div class="col-sm-1"></div>
</div>