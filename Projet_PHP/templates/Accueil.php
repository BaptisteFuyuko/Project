<?php
include("Navbar.php");
?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 3vh;
        margin-bottom: 3vh;
        font-size: 4.5vh;
        text-align: center;
    }

    input{
        margin-top: 1vh;
        color: #888888;
    }

    label {
        font-size: 2.5vh;
        color: #ef4527;
        text-align: center;
    }

    .form-group, .launch{
        margin-bottom: 3vh;
    }

    .ERR {
        margin-bottom: 1vh;
        text-align: center;
        color: red;
        font-size: 2vh;
    }

    .HELP {
        margin-bottom: 2vh;
        text-align: center;
    }

    .log {
        vertical-align: middle;
        border: 1px black solid;
    }
</style>

<div class="container" style="padding-top: 8vh;">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 log">
        <h1>Lancer un Test</h1>
        <form class="form-horizontal" role="form" method="post" action="controleur.php">

            <div class="form-group 
            <?php
            if (isset($_GET['nom'])) {
                if ($_GET['nom'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="col-sm-12">*Nom:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" placeholder="Nom"
                        <?php
                        if (isset($_GET['nom'])) {
                            if ($_GET['nom'] != 'false') {
                                echo 'value="' . $_GET['nom'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>

            <div class="form-group
            <?php
            if (isset($_GET['prenom'])) {
                if ($_GET['prenom'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="col-sm-12">*Prénom:</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" placeholder="Prénom"
                        <?php
                        if (isset($_GET['prenom'])) {
                            if ($_GET['prenom'] != 'false') {
                                echo 'value="' . $_GET['prenom'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>

            <div class="form-group
            <?php
            if (isset($_GET['email'])) {
                if ($_GET['email'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="col-sm-12">*E-mail:</label><?php
                if (isset($_GET['aemail'])) {
                    if ($_GET['aemail'] == 'used') {
                        ?>

                        <div class="col-sm-12 ERR">Erreur : Cet adresse E-mail est déjà utilisée par un autre candidat</div>

                        <?php
                    }
                }
                ?>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" placeholder="Addresse mail"
                        <?php
                        if (isset($_GET['email'])) {
                            if ($_GET['email'] != 'false') {
                                echo 'value="' . $_GET['email'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>

            <div class="form-group
            <?php
            if (isset($_GET['test'])) {
                if ($_GET['test'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="col-sm-12">*Quel test ?</label>
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input list="test" type="text" class="form-control" name="test" placeholder="Nom du test - Catégorie" autocomplete="off">
                    <datalist id="test">
                        <?php
                        $p = Listnomtest();
                        foreach ($p as $dataP){
                            echo '<option value="' . $dataP['Nom'] . ' - ' . $dataP['Categorie'] . ' - ' . $dataP['id_test'] . '">';
                        }
                        ?>
                    </datalist>
                </div>
            </div>

            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'empty') {
                    ?>

                    <div class="col-sm-12 ERR">Erreur : Veuillez saisir tous les champs</div>

                    <?php
                }
            }
            ?>

            <div class="col-sm-12 HELP">Tous les champs présentant le symbole * sont obligatoires</div>

            <div class="form-actions">
                <div class="col-sm-12" style="text-align: center;">
                    <button type="submit" class="btn btn-default launch" name="action" value="lancertest">Lancer le test</button>
                </div>
            </div>

        </form>
    </div>
</div>