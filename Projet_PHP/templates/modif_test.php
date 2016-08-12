<?php
include("Navbar.php");
$id_test = $_GET['id'];
$infos_test = getinfostest($id_test)[0];

?>

<script>
    $(document).ready(function(){

        $(".bloc_questionnaire").on('click', '.add_reponse', function(){
            var question = $(this).attr('class');
            question = question.split(" ")[2];
            var id_question = question.split("-")[1];
            var rep = 1;
            if ($(".q" + id_question).length){
                var last_rep = $(".q" + id_question + ":last").attr('class');
                rep = last_rep.split(" ")[3];
                rep++;
            }
            $(this).parent()
                .before('<div class="col-sm-12 rep q' + id_question + ' ' + rep + '"><div>');
            $(".q" + id_question + ":last")
                .html('<label class="control-label col-sm-1" for="J' + id_question + '-' + rep + '">Juste:</label>')
                .append('<div class="col-sm-1"><input type="checkbox" class="form-control" name="J-' + id_question + '-' + rep + '" id="J' + id_question + '-' + rep + '" value="J-' + id_question + '-' + rep + '" id="J' + id_question + '-' + rep + '"/></div>')
                .append('<label class="control-label col-sm-1" for="R' + id_question + '-' + rep + '">Réponse:</label>')
                .append('<div class="col-sm-8 rep"><input type="text" class="form-control" name="' + id_question + '-' + rep + '" id="R' + id_question + '-' + rep + '" placeholder="Intitulé de la réponse"></div>')
                .append('<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>');
        });

        $("#add_question").click(function(){
            var id_question = 1;
            if ($(".questionnaire").length) {
                id_question = $(".questionnaire:last").parent().attr("id");
                id_question++;
            }
            $(this).parent()
                .before('<div class="col-sm-12" id="' + id_question + '"></div>');
            $("#" + id_question)
                .html('<div class="col-sm-2"></div>')
                .append('<div class="form-group questionnaire col-sm-8"></div>');
            $("#" + id_question + " > .questionnaire")
                .html('<div class="col-sm-12 head"></div>');
            $("#" + id_question + " > .questionnaire > .head")
                .html('<div class="col-sm-1"></div>'+
                    '<div class="col-sm-10">Question ' + id_question + ' :</div>'+
                    '<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmquestion"></span></div>');
            $("#" + id_question + " > .questionnaire")
                .append(
                    '<div class="col-sm-12 question ' + id_question + '">' +
                    '<label class="control-label col-sm-1" for="q' + id_question + '">Intitulé:</label>' +
                    '<div class="col-sm-9">' +
                    '<input type="text" class="form-control" name="' + id_question + '" id="q' + id_question + '" placeholder="Intitulé de la question">' +
                    '</div>' +
                    '<label class="control-label col-sm-1" for="m' + id_question + '">QCM :</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="checkbox" class="form-control" name="M-' + id_question + '" id="m' + id_question + '" value="M-' + id_question + '"/>' +
                    '</div>' +
                    '</div>'
                )
                .append(
                    '<div class="col-sm-12 rep q' + id_question + ' 1">' +
                    '<label class="control-label col-sm-1" for="J' + id_question + '-1">Juste:</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="checkbox" class="form-control" name="J-' + id_question + '-1" id="J' + id_question + '-1" value="J-' + id_question + '-1"/>' +
                    '</div>' +
                    '<label class="control-label col-sm-1" for="R' + id_question + '-1">Réponse:</label>' +
                    '<div class="col-sm-8">' +
                    '<input type="text" class="form-control" name="' + id_question + '-1" id="R' + id_question + '-1" placeholder="Intitulé de la réponse">' +
                    '</div>' +
                    '<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>' +
                    '</div>'
                )
                .append(
                    '<div class="col-sm-12 rep q' + id_question + ' 2">' +
                    '<label class="control-label col-sm-1" for="J' + id_question + '-2">Juste:</label>' +
                    '<div class="col-sm-1">' +
                    '<input type="checkbox" class="form-control" name="J-' + id_question + '-2" id="J' + id_question + '-2" value="J-' + id_question + '-2"/>' +
                    '</div>' +
                    '<label class="control-label col-sm-1" for="R' + id_question + '-2">Réponse:</label>' +
                    '<div class="col-sm-8 rep">' +
                    '<input type="text" class="form-control" name="' + id_question + '-2" id="R' + id_question + '-2" placeholder="Intitulé de la réponse">' +
                    '</div>' +
                    '<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>' +
                    '</div>'
                )
                .append(
                    '<div class="col-sm-12">' +
                    '<div class="col-sm-3"></div>' +
                    '<div class="col-sm-6 add q-' + id_question + ' add_reponse" > Ajouter une réponse </div>' +
                    '</div>'
                );
        });

        $(".bloc_questionnaire").on('click', '.rmreponse', function(){
            $(this).parent().parent().remove();
        });

        $(".bloc_questionnaire").on('click', '.rmquestion', function(){
            var id_del = $(this).parent().parent().parent().parent().attr('id');
            $(this).parent().parent().parent().parent().remove();
            id_del++;
            id_del--;
            var id_next = id_del + 1;
            while ($("#" + id_next).length) {
                $("#" + id_next + " > .questionnaire > .head > .col-sm-10").text('Question ' + id_del + ' :');
                $("#" + id_next).attr("id", id_del);
                id_del++;
                id_next++;
            }
        });
    });
</script>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 3vh;
        margin-bottom: 3vh;
        font-size: 4.5vh;
    }

    .questionnaire {
        border: 1px #ef4527 solid;
        padding-left: 0;
        padding-right: 0;
    }

    .head {
        border-bottom: 1px #ef4527 solid;
        font-size : 2vh;
        text-align: center;
        margin-bottom: 1vh;
        padding: 0;
    }

    .add {
        border: 1px black dashed;
        margin-bottom: 2vh;
        cursor: pointer;
        height: 3vh;
        line-height: 3vh;
    }

    .add:hover {
        border: 1px #ef4527 dashed;
        height: 3vh;
        line-height: 3vh;
    }

    .rep, .question {
        margin-bottom: 1vh;
    }

    label {
        color: #ef4527;
    }

    .glyphicon-remove {
        color: #ef4527;
        line-height: 100%;
        text-align: right;
        cursor: pointer;
    }

    .glyphicon-remove:hover {
        background-color: #A1A09B;
    }

    .cache {
        display: none;
    }
</style>

<div class="container-fluid">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="col-sm-6">
            <h1>Modification du <?php echo $infos_test['Nom'] ; ?></h1>
        </div>
        <div class="col-sm-12" style="overflow: auto; max-height: 70vh !important;">
            <form name="form_test" class="form-horizontal" role="form" method="post" action="controleur.php" style="
        max-height: 70vh !important;
        overflow: auto;
        overflow-x: hidden;
        ">

                <div class="form-group col-sm-11">
                    <input class="cache" name="id" value="<?php echo $id_test ?>">
                    <label class="control-label col-sm-5" for="nom">Nom du test :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $infos_test['Nom'] ; ?>">
                    </div>
                </div>


                <div class="form-group col-sm-11">
                    <label class="control-label col-sm-5" for="cat">Catégorie :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="cat" id="cat" value="<?php echo $infos_test['Categorie'] ; ?>">
                    </div>
                </div>

                <div class="col-sm-2"></div>
                <h2 class="col-sm-10">Questionnaire :</h2>
                <div class="col-sm-12 bloc_questionnaire">

                    <?php
                    $p = getquestionreponsejuste_idtest($id_test);
                    $idquestion = getquestion_idtest($id_test);
                    $i = 0;
                    $r = 1;
                    foreach ($p as $dataP) {
                        if (isset($idquestion[$i]['id_question']) AND $idquestion[$i]['id_question'] == $dataP['id']){
                            if ($i!=0) {
                                echo '<div class="col-sm-12">';
                                echo '<div class="col-sm-3"></div>';
                                echo '<div class="col-sm-6 add q-' . ($i-1) . ' add_reponse"> Ajouter une réponse </div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '<div class="col-sm-12" id="' . ($i+1) . '">';
                            echo '<div class="col-sm-2"></div>';
                            echo '<div class="form-group questionnaire col-sm-8">';
                            echo '<div class="col-sm-12 head">';
                            echo '<div class="col-sm-1"></div>';
                            echo '<div class="col-sm-10">Question ' . ($i+1) . ' :</div>';
                            echo '<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmquestion"></span></div>';
                            echo '</div>';

                            echo '<div class="col-sm-12 question ' . ($i+1) . '">';
                            echo '<input class="cache" name="O-Q-' . $dataP['id'] . '" value="old">';
                            echo '<label class="control-label col-sm-1" for="q' . ($i+1) . '">Intitulé:</label>';
                            echo '<div class="col-sm-9">';
                            echo '<input type="text" class="form-control" name="' . ($i+1) . '" id="q' . ($i+1) . '" value="' . $dataP['Intitule_Question'] . '">';
                            echo '</div>';
                            echo '<label class="control-label col-sm-1" for="m' . ($i+1) . '">QCM :</label>';
                            echo '<div class="col-sm-1">';
                            echo '<input type="checkbox" class="form-control" name="M-' . ($i+1) . '" id="m' . ($i+1) . '" value="M-' . ($i+1) . '"';
                            if( $dataP['Multiple'] == 1)
                                echo 'checked';
                            echo '/>';
                            echo '</div>';
                            echo '</div>';
                            $i++;
                            $r = 1;
                        }
                        echo '<div class="col-sm-12 rep q' . $i . ' ' . $r . '">';
                        echo '<input class="cache" name="O-R-' . $dataP['id_rep'] . '" value="old">';
                        echo '<label class="control-label col-sm-1" for="J' . $i . '-' . $r . '">Juste:</label>';
                        echo '<div class="col-sm-1">';
                        echo '<input type="checkbox" class="form-control" name="J-' . $i . '-' . $r . '" id="J' . $i . '-' . $r . '" value="J-' . $i . '-' . $r . '"';
                        if( $dataP['Juste'] == 1)
                            echo 'checked';
                        echo '/>';
                        echo '</div>';
                        echo '<label class="control-label col-sm-1" for="R' . $i . '-' . $r . '">Réponse:</label>';
                        echo '<div class="col-sm-8">';
                        echo '<input type="text" class="form-control" name="' . $i . '-' . $r . '" id="R' . $i . '-' . $r . '" value="' . $dataP['Intitule_reponse'] . '">';
                        echo '</div>';
                        echo '<div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>';
                        echo '</div>';
                        $r++;
                    }
                    echo '<div class="col-sm-12">';
                    echo '<div class="col-sm-3"></div>';
                    echo '<div class="col-sm-6 add q-' . $i . ' add_reponse"> Ajouter une réponse </div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    ?>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 add" id="add_question"> Ajouter une question </div>
                    </div>
                </div>

                <div class="form-actions col-sm-12">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <button onClick="document.form_test.submit();" class="btn btn-default" style="color: #ef4527; border: 1px #888888 solid;" name="action" value="modifTest">Valider</button>
                        <a href="index.php?page=LT"><button type="button" class="btn btn-default" style="color: #ef4527; background-color: white; border: 1px #888888 solid;"> Annuler </button></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>