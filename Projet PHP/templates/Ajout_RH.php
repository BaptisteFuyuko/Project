<?php include("Navbar.php"); ?>

<style type="text/css">
    h1 {
        color: #ef4527;
        margin-top: 5vh;
        margin-bottom: 10vh;
    }

    input{
        margin-top: 1vh;
        color: #888888;
    }

    label {
        font-size: 2.5vh;
        color: #ef4527;
    }

    h1 {
        font-size: 4.5vh;
    }

    .form-group{
        margin-bottom: 5vh;
    }

    .ERR {
        margin-bottom: 2vh;
        text-align: center;
        color: red;
        font-size: 2vh;
    }

    .HELP {
        margin-bottom: 2vh;
        text-align: center;
    }
</style>

<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <h1>Ajout d'un RH</h1>
        <form class="form-horizontal" role="form" method="post" action="controleur.php" style="
        max-height: 70vh !important;
        overflow: auto;
        overflow-x: hidden;
        ">


            <div class="form-group
            <?php
            if (isset($_GET['nom'])) {
                if ($_GET['nom'] == 'false') {
                    

                    echo ' has-error has-feedback';
                
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="nom">*Nom:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom"
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
                <label class="control-label col-sm-4" for="prenom">*Prénom:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom"
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
            if (isset($_GET['BU'])) {
                if ($_GET['BU'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="bu">*BU d'origine:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="BU" id="bu" placeholder="BU d'origine"
                        <?php
                        if (isset($_GET['BU'])) {
                            if ($_GET['BU'] != 'false') {
                                echo 'value="' . $_GET['BU'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>


            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'double') {
                    ?>

                    <div class="col-sm-10 ERR">Erreur : Login déjà utilisé</div>

                    <?php
                }
            }
            ?>
            <div class="form-group
            <?php
            if (isset($_GET['login'])) {
                if ($_GET['login'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="email">*Login:</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="login" id="email" placeholder="abcde@fghi.jkl"
                        <?php
                        if (isset($_GET['login'])) {
                            if ($_GET['login'] != 'false') {
                                echo 'value="' . $_GET['login'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>


            <div class="form-group
            <?php
            if (isset($_GET['pwd'])) {
                if ($_GET['pwd'] == 'false') {
                    echo ' has-error has-feedback';
                }
            }
            ?>
            ">
                <label class="control-label col-sm-4" for="pwd">*Mot de passe:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Entrez le mot de passe"
                        <?php
                        if (isset($_GET['pwd'])) {
                            if ($_GET['pwd'] != 'false') {
                                echo 'value="' . $_GET['pwd'] . '"';
                            }
                        }
                        ?>
                    >
                </div>
            </div>


            <?php
            if (isset($_GET['ERR'])) {
                if ($_GET['ERR'] == 'empty') {
                    ?>

                    <div class="col-sm-10 ERR">Erreur : Veuillez remplir tous les champs</div>

                    <?php
                }
            }
            ?>

            <div class="col-sm-10 HELP">Tous les champs présentant le symbole * sont obligatoires</div>

            <div class="form-actions">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-default" style="color: #ef4527; border: 1px #888888 solid;" name="action" value="ajoutRH">Valider</button>
                    <a href="index.php?page=LRH"><button type="button" class="btn" style="color: #ef4527; background-color: white; border: 1px #888888 solid;"> Annuler </button></a>
                </div>
            </div>
        </form>
    </div>
</div>