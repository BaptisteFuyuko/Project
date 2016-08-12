<?php
include("Navbar.php");
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
</style>

<div class="container-fluid">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="col-sm-6">
            <h1>Ajout d'un nouveau test</h1>
        </div>
        <div class="col-sm-12" style="overflow: auto; max-height: 70vh !important;">
            <form name="form_test" class="form-horizontal" role="form" method="post" action="controleur.php" style="
        max-height: 70vh !important;
        overflow: auto;
        overflow-x: hidden;
        ">

                <div class="form-group col-sm-11">
                    <label class="control-label col-sm-5" for="nom">Nom du test :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du test">
                    </div>
                </div>


                <div class="form-group col-sm-11">
                    <label class="control-label col-sm-5" for="cat">Catégorie :</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="cat" id="cat" placeholder="Catégorie">
                    </div>
                </div>


                <div class="col-sm-2"></div>
                <h2 class="col-sm-10">Questionnaire :</h2>
                <div class="col-sm-12 bloc_questionnaire">
                    <div class="col-sm-12" id="1">
                        <div class="col-sm-2"></div>
                        <div class="form-group questionnaire col-sm-8">
                            <div class="col-sm-12 head">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">Question 1 :</div>
                                <div class="col-sm-1"><span class="glyphicon glyphicon-remove rmquestion"></span></div>
                            </div>

                            <div class="col-sm-12 question 1">
                                <label class="control-label col-sm-1" for="q1">Intitulé:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="1" id="q1" placeholder="Intitulé de la question">
                                </div>
                                <label class="control-label col-sm-1" for="m1">QCM :</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" class="form-control" name="M-1" id="m1" value="M-1"/>
                                </div>
                            </div>

                            <div class="col-sm-12 rep q1 1">
                                <label class="control-label col-sm-1" for="J1-1">Juste:</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" class="form-control" name="J-1-1" id="J1-1" value="J-1-1"/>
                                </div>
                                <label class="control-label col-sm-1" for="R1-1">Réponse:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="1-1" id="R1-1" placeholder="Intitulé de la réponse">
                                </div>
                                <div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>
                            </div>

                            <div class="col-sm-12 rep q1 2">
                                <label class="control-label col-sm-1" for="J1-2">Juste:</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" class="form-control" name="J-1-2" id="J1-2" value="J-1-2"/>
                                </div>
                                <label class="control-label col-sm-1" for="R1-2">Réponse:</label>
                                <div class="col-sm-8 rep">
                                    <input type="text" class="form-control" name="1-2" id="R1-2" placeholder="Intitulé de la réponse">
                                </div>
                                <div class="col-sm-1"><span class="glyphicon glyphicon-remove rmreponse"></span></div>
                            </div>

                            <div class="col-sm-12">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6 add q-1 add_reponse"> Ajouter une réponse </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 add" id="add_question"> Ajouter une question </div>
                    </div>
                </div>

                <div class="form-actions col-sm-12">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <button onClick="document.form_test.submit();" class="btn btn-default" style="color: #ef4527; border: 1px #888888 solid;" name="action" value="ajoutTest">Valider</button>
                        <a href="index.php?page=LT"><button type="button" class="btn btn-default" style="color: #ef4527; background-color: white; border: 1px #888888 solid;"> Annuler </button></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>